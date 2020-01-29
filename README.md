## 文件批量导出并打包（zip）

#### 安装

```php
composer require quansitech/qscmf-topbutton-download
```

#### 使用样例
```php
.
.
.
class PostController extends GyListController{
.
.
.
    
        $builder = new \Common\Builder\ListBuilder();
        //第一个参数指定download类型，第二个参数是指定需要覆盖的html组件属性
        /*属性值如下
                必填：data-url   为点击导出按钮后ajax请求的地址
                选填：
                    data-filename  批量导出压缩包文件名
                    title           按钮名称
                    data-select     值为bool类型，判断是否勾选，默认true，即默认开启
                    data-tips       承接data-select属性，如果开启，在未勾选内容情况下提示的信息
         */
        $builder->addTopButton('download', array('data-url' => U('download')));
    
.
.
.
    
    /*
    导出下载链接请求的action
    ajax返回json数据格式如下：
        {
            "count": "5",
            "pageSize": 2,
            "list": [
                {
                    "id": "1",
                    "name": "下载重命名的文件名",
                    "url": "https://media.t4tstudio.com/TJlJL2wlKB4Ezb5_qQrp0okWb2c=/Fv2T8J6s6Pupj6zbs2xvdMf9GKN2",
                    "suffix": "mp3"
                },
                ....
            ]
        }
        返回值注解（下面所有键名必填）：
        count   总记录数
        pageSize 单页最大记录数    注意：如果是下载单页的数据，令count<=pageSize即可
        list    下载的数据列表
            id  数据的id
            name  重命名的文件名   注意：请遵守操作系统文件命名规范
            url   下载链接地址
            suffix 文件后缀名
    */
    public function download(){
        //$page 为页码，若不需要请忽略该值
        $page = I('page',1);
        $count = M('Test')->count();
        $pageSize = C('ADMIN_PER_PAGE_NUM', null, false);
        $data = M('Test')->page($page,$pageSize)->select();
        $return_data = [
            'count' => $count,
            'pageSize' => $pageSize,
            'list'=>$data,
        ];
        $this->ajaxReturn($return_data);
    }

```