<?php
namespace Qs\TopButton;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;
use Qs\TopButton\Download\Download;

class DownloadProvider implements Provider{

    public function register(){
        RegisterContainer::registerListTopButton('download', Download::class);

        RegisterContainer::registerSymLink(WWW_DIR . '/Public/download-file', __DIR__ . '/../asset/download-file');
    }
}