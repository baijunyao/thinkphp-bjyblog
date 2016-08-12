<?php

return array(
    'URL_ROUTER_ON'         =>  true,                           // 开启路由
    'URL_ROUTE_RULES'       =>  array(                          // 路由规则
        'index/:p\d'=>'Index/index',                            // 首页路由
        'category/:cid\d'=>'Index/category',                    // 分类路由
        'tag/:tid\d'=>'Index/tag',                              // 标签路由
        'article/cid/:cid\d/:aid\d'=>'Index/article',           // 分类-文章路由
        'article/tid/:tid\d/:aid\d'=>'Index/article',           // 标签-文章路由
        'article/sw/:search_word\S/:aid\d'=>'Index/article',    // 搜索词-文章路由
        'article/:aid\d'=>'Index/article',                      // 文章路由
        'chat'=>'Index/chat',                                   // 随言碎语路由
        'git'=>'Index/git',                                   // 开源项目路由
        ),
);
