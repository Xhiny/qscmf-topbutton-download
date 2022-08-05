<?php
namespace Qs\TopButton\Download;

use Illuminate\Support\Str;
use Qscmf\Builder\ButtonType\ButtonType;
use Think\View;

class Download extends ButtonType{

    public function build(array &$option){
        $my_attribute['type'] = 'download';
        $my_attribute['title'] = '文件批量导出';
        $my_attribute['data-filename'] = '批量导出文件';//导出压缩包的文件名
        $my_attribute['data-select'] = 'true';//是否需要勾选ids才能操作，默认开启
        $my_attribute['data-tips'] = '请勾选导出的内容';//承接上面data-select属性，给出相应的提示
        $my_attribute['target-form'] = 'ids';
        $my_attribute['class'] = 'btn btn-primary download_many_file';

        if ($option['attribute'] && is_array($option['attribute'])) {
            $option['attribute'] = array_merge($my_attribute, $option['attribute']);
        }

        $gid = Str::uuid();
        $gid = str_replace('-', '', $gid);
        $option['attribute']['id'] = 'modal-' . $gid;

        $view = new View();
        $view->assign('gid', $gid);
        $content = $view->fetch(__DIR__ . '/download.html');
        return $content;
    }
}