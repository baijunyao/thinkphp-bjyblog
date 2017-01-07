<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
* 文章model
*/
class ArticleModel extends BaseModel{
    // 自动验证
    protected $_validate=array(
        array('tid','require','必须选择栏目'),
        array('title','require','文章标题必填'),
        array('author','require','作者必填'),
        array('content','require','文章内容必填'),
        );

    // 自动完成
    protected $_auto=array(
        array('click',0),
        array('is_delete',0),
        array('addtime','time',1,'function'),
        array('description','getDescription',3,'callback'),
        array('keywords','comma2coa',3,'callback'),
        );

    // 获得描述；供自动完成调用
    protected function getDescription($description){
        if(!empty($description)){
            return $description;
        }else{
            $data=I('post.content');
            $des=htmlspecialchars_decode($data);
            $des=re_substr(strip_tags($des),0,200,false);
            return $des;
        }
    }

    // 顿号转换为英文逗号
    protected function comma2coa($keywords){
        return str_replace('、', ',', $keywords);
    }

    // 添加数据
    public function addData(){
        // 获取post数据
        $data=I('post.');
        // 反转义为下文的 preg_replace使用
        $data['content']=htmlspecialchars_decode($data['content']);
        // 判断是否修改文章中图片的默认的alt 和title
        $image_title_alt_word=C('IMAGE_TITLE_ALT_WORD');
        if(!empty($image_title_alt_word)){
            // 修改图片默认的title和alt
            $data['content']=preg_replace('/title=\"(?<=").*?(?=")\"/','title="白俊遥博客"',$data['content']);
            $data['content']=preg_replace('/alt=\"(?<=").*?(?=")\"/','alt="白俊遥博客"',$data['content']);
        }
        // 将绝对路径转换为相对路径
        $data['content']=preg_replace('/src=\"^\/.*\/Upload\/image\/ueditor$/','src="/Upload/image/ueditor',$data['content']);
        // 转义
        $data['content']=htmlspecialchars($data['content']);
        if($this->create($data)){
            //获取文章内容图片
            $image_path=get_ueditor_image_path($data['content']);
            if($aid=$this->add()){
                if(isset($data['tids'])){
                    D('ArticleTag')->addData($aid,$data['tids']);
                }
                if(!empty($image_path)){
                    // 添加水印
                    if(C('WATER_TYPE')!=0){
                        foreach ($image_path as $k => $v) {
                            add_water('.'.$v);
                        }
                    }
                    // 传递图片插入数据库
                    D('ArticlePic')->addData($aid,$image_path);
                }
                // 获取未删除和展示的文章
                $sitemap_map=array(
                    'is_show'=>1,
                    'is_delete'=>0
                    );
                $list=M('Article')
                    ->field('aid,addtime')
                    ->where($sitemap_map)
                    ->order('aid desc')
                    ->select();
                // 生成sitemap文件
                $sitemap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<urlset>\r\n";
                foreach($list as $k=>$v){
                    $sitemap .= "    <url>\r\n"."        <loc>".U('Home/Index/article',array('aid'=>$v['aid']),'',true)."</loc>\r\n"."        <lastmod>".date('Y-m-d',$v['addtime'])."</lastmod>\r\n        <changefreq>weekly</changefreq>\r\n        <priority>0.8</priority>\r\n    </url>\r\n";
                }
                $sitemap .= '</urlset>';
                file_put_contents('./sitemap.xml',$sitemap);
                return $aid;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // 修改数据
    public function editData(){
        // 获取post数据
        $data=I('post.');
        // 反转义为下文的 preg_replace使用
        $data['content']=htmlspecialchars_decode($data['content']);
        // 判断是否修改文章中图片的默认的alt 和title
        $image_title_alt_word=C('IMAGE_TITLE_ALT_WORD');
        if(!empty($image_title_alt_word)){
            // 修改图片默认的title和alt
            $data['content']=preg_replace('/title=\"(?<=").*?(?=")\"/','title="白俊遥博客"',$data['content']);
            $data['content']=preg_replace('/alt=\"(?<=").*?(?=")\"/','alt="白俊遥博客"',$data['content']);
        }
        // 将绝对路径转换为相对路径
        $data['content']=preg_replace('/src=\"^\/.*\/Upload\/image\/ueditor$/','src="/Upload/image/ueditor',$data['content']);
        $data['content']=htmlspecialchars($data['content']);
        if($this->create($data)){
            $aid=$data['aid'];
            $this->where(array('aid'=>$aid))->save();
            $image_path=get_ueditor_image_path($data['content']);
            D('ArticleTag')->deleteData($aid);
            if(isset($data['tids'])){
                D('ArticleTag')->addData($aid,$data['tids']);
            }
            // 删除图片路径
            D('ArticlePic')->deleteData($aid);
            if(!empty($image_path)){
                if(C('WATER_TYPE')!=0){
                    foreach ($image_path as $k => $v) {
                        add_water('.'.$v);
                    }
                }
                // 添加新图片路径
                D('ArticlePic')->addData($aid,$image_path);
            }
            return true;
        }else{
            return false;
        }
    }

    // 彻底删除
    public function deleteData(){
        $aid=I('get.aid',0,'intval');
        D('ArticlePic')->deleteData($aid);
        D('ArticleTag')->deleteData($aid);
        $this->where(array('aid'=>$aid))->delete();
        return true;
    }

    /**
     * 获得文章分页数据
     * @param strind $cid 分类id 'all'为全部分类
     * @param strind $tid 标签id 'all'为全部标签
     * @param strind $is_show   是否显示 1为显示 0为显示
     * @param strind $is_delete 状态 1为删除 0为正常
     * @param strind $limit 分页条数
     * @return array $data 分页样式 和 分页数据
     */
    public function getPageData($cid='all',$tid='all',$is_show='1',$is_delete=0,$limit=10){
        if($cid=='all' && $tid=='all'){
            // 获取全部分类、全部标签下的文章
            if($is_show=='all'){
                $where=array(
                    'is_delete'=>$is_delete
                    );
            }else{
                $where=array(
                    'is_delete'=>$is_delete,
                    'is_show'=>$is_show
                    );
            }
            $count=$this
                ->where($where)
                ->count();
            $page=new \Org\Bjy\Page($count,$limit);
            $list=$this
                ->where($where)
                ->order('addtime desc')
                ->limit($page->firstRow.','.$page->listRows)
                ->select();
            $extend=array(
                'type'=>'index',
                'id'=>0
                );
        }elseif ($cid=='all' && $tid!='all') {
            // 获取tid下的全部文章
            if($is_show=='all'){
                $where=array(
                    'at.tid'=>$tid,
                    'a.is_delete'=>$is_delete
                    );
            }else{
                $where=array(
                    'at.tid'=>$tid,
                    'a.is_delete'=>$is_delete,
                    'a.is_show'=>$is_show
                    );
            }
            $count=M('article_tag')
                ->alias('at')
                ->join('__ARTICLE__ a ON at.aid=a.aid')
                ->where($where)
                ->count();
            $page=new \Org\Bjy\Page($count,$limit);
            $list=M('article_tag')
                ->alias('at')
                ->join('__ARTICLE__ a ON at.aid=a.aid')
                ->where($where)
                ->order('a.addtime desc')
                ->limit($page->firstRow.','.$page->listRows)
                ->select();
            $extend=array(
                'type'=>'tid',
                'id'=>$tid
                );
        }elseif ($cid!='all' && $tid=='all') {
            // 获取cid下的全部文章
            if($is_show=='all'){
                $where=array(
                    'cid'=>$cid,
                    'is_delete'=>$is_delete,
                    );
            }else{
                $where=array(
                    'cid'=>$cid,
                    'is_delete'=>$is_delete,
                    'is_show'=>$is_show
                    );
            }
            $count=$this
                ->where($where)
                ->count();
            $page=new \Org\Bjy\Page($count,$limit);
            $list=$this
                ->where($where)
                ->order('addtime desc')
                ->limit($page->firstRow.','.$page->listRows)
                ->select();
            $extend=array(
                'type'=>'cid',
                'id'=>$cid
                );
        }
        $show=$page->show();
        foreach ($list as $k => $v) {
            $list[$k]['addtime']=word_time($v['addtime']);
            $list[$k]['tag']=D('ArticleTag')->getDataByAid($v['aid'],'all');
            $list[$k]['pic_path']=D('ArticlePic')->getDataByAid($v['aid']);
            $list[$k]['category']=current(D('Category')->getDataByCid($v['cid'],'cid,cid,cname'));
            $v['content']=preg_ueditor_image_path($v['content']);
            $list[$k]['content']=htmlspecialchars($v['content']);
            $list[$k]['url']=U('Home/Index/article/',array('aid'=>$v['aid']));
            $list[$k]['extend']=$extend;
        }
        $data=array(
            'page'=>$show,
            'data'=>$list,
            );
        return $data;
    }

    // 传递aid获取单条全部数据 $map 主要为前台页面上下页使用
    public function getDataByAid($aid,$map=''){
        if($map==''){
            // $map 为空则不获取上下篇文章
            $data=$this->where(array('aid'=>$aid))->find();
            $data['tids']=D('ArticleTag')->getDataByAid($aid);
            $data['tag']=D('ArticleTag')->getDataByAid($aid,'all');
            $data['category']=current(D('Category')->getDataByCid($data['cid'],'cid,cid,cname,keywords'));
            // 获取相对路径的图片地址
            $data['content']=preg_ueditor_image_path($data['content']);
        }else{
            if(isset($map['tid'])){
                // 根据此标签tid获取上下篇文章
                $prev_map['at.tid']=$map['tid'];
                $prev_map[]=array('a.is_show'=>1);
                $prev_map[]=array('a.is_delete'=>0);
                $next_map=$prev_map;
                $prev_map['a.aid']=array('gt',$aid);
                $next_map['a.aid']=array('lt',$aid);
                $data['prev']=$this->field('a.aid,a.title')->alias('a')->join('__ARTICLE_TAG__ at ON a.aid=at.aid')->where($prev_map)->limit(1)->find();
                $data['next']=$this->field('a.aid,a.title')->alias('a')->join('__ARTICLE_TAG__ at ON a.aid=at.aid')->where($next_map)->order('a.aid desc')->limit(1)->find();
            }else if(isset($map['cid'])){
                // 根据此分类cid获取上下篇文章
                $prev_map=$map;
                $prev_map[]=array('is_show'=>1);
                $prev_map[]=array('is_delete'=>0);
                $next_map=$prev_map;
                $prev_map['aid']=array('gt',$aid);
                $next_map['aid']=array('lt',$aid);
                $data['prev']=$this->field('aid,title')->where($prev_map)->limit(1)->find();
                $data['next']=$this->field('aid,title')->where($next_map)->order('aid desc')->limit(1)->find();
            }else{
                // 根据搜索词获取上下篇文章
                $prev_map=array('title'=>array('like','%'.$map['title'].'%'));
                $prev_map[]=array('is_show'=>1);
                $prev_map[]=array('is_delete'=>0);
                $next_map=$prev_map;
                $prev_map['aid']=array('gt',$aid);
                $next_map['aid']=array('lt',$aid);
                $data['prev']=$this->field('aid,title')->where($prev_map)->limit(1)->find();
                $data['next']=$this->field('aid,title')->where($next_map)->order('aid desc')->limit(1)->find();
            }
            // 如果不为空 添加url
            if(!empty($data['prev'])){
                $data['prev']['url']=U('Home/Index/article/',array('aid'=>$data['prev']['aid']));
            }
            if(!empty($data['next'])){
                $data['next']['url']=U('Home/Index/article/',array('aid'=>$data['next']['aid']));
            }
            $data['current']=$this->where(array('aid'=>$aid))->find();
            $data['current']['tids']=D('ArticleTag')->getDataByAid($aid);
            $data['current']['tag']=D('ArticleTag')->getDataByAid($aid,'all');
            $data['current']['category']=current(D('Category')->getDataByCid($data['current']['cid'],'cid,cid,cname,keywords'));
            $data['current']['content']=preg_ueditor_image_path($data['current']['content']);
        }
        return $data;
    }

    // 传递搜索词获取数据
    public function getDataByTitle($search_word){
        $map=array(
            'title'=>array('like',"%$search_word%")
            );
        $count=$this->where($map)->count();
        $page=new \Org\Bjy\Page($count,10);
        $list=$this
            ->where($map)
            ->order('addtime desc')
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        foreach ($list as $k => $v) {
            $list[$k]['pic_path']=D('ArticlePic')->getDataByAid($v['aid']);
            $list[$k]['url']=U('Home/Index/article/',array('search_word'=>$search_word,'aid'=>$v['aid']));
            $list[$k]['tids']=D('ArticleTag')->getDataByAid($v['aid']);
            $list[$k]['tag']=D('ArticleTag')->getDataByAid($v['aid'],'all');
            $list[$k]['category']=current(D('Category')->getDataByCid($v['cid'],'cid,cid,cname,keywords'));
            $list[$k]['addtime']=word_time($v['addtime']);
        }
        $show=$page->show();
        $data=array(
            'page'=>$show,
            'data'=>$list
            );
        return $data;
    }

    // 传递cid获得此分类下面的文章数据
    // is_all为true时获取全部数据 false时不获取is_show为0 和is_delete为1的数据
    public function getDataByCid($cid,$is_all=false){
        if($is_all){
            return $this->order('addtime desc')->select();
        }else{
            $where=array(
                'cid'=>$cid,
                'is_show'=>1,
                'is_delete'=>0,
            );
            return $this->where($where)->order('addtime desc')->select();
        }

    }

    // 传递$map获取count数据
    public function getCountData($map=array()){
        return $this->where($map)->count();
    }

}

