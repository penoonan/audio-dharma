<?php

namespace AudioDharma;

use AudioDharma\Base\MenuHandler;
use AudioDharma\Base\Request;
use AudioDharma\Base\WpApiWrapper;
use League\Plates\Template;

class SettingsMenuHandler implements MenuHandler {

    /**
     * @var \League\Plates\Template
     */
    private $template;

    /**
     * @var Base\WpApiWrapper
     */
    private $wp;

    /**
     * @var Base\Request
     */
    private $request;

    public function __construct(Template $template, WpApiWrapper $wp, Request $request)
    {
        $this->template = $template;
        $this->wp = $wp;
        $this->request = $request;
    }

    public function handle()
    {
        if ($this->request->method('get')) {
            return $this->show();
        } elseif ($this->request->method('post')) {
            return $this->save();
        }
    }

    protected function show($settings = null)
    {
        $data['settings'] = $settings ?: $this->wp->get_option('cgmcdt_mp3_tag_setttings');
        echo $this->template->render('settings_menu', $data);
    }

    protected function save()
    {
        $settings = $this->request->post('settings');
        foreach($settings as $k => $v) {
            if($k === 'tcop') {
                $start = substr($v, 0, 4);
                if (!ctype_digit($start)) {
                    $v = date('Y') . ' ' . ltrim($v);
                }
            }

            $settings[$k] = $this->wp->sanitize_text_field($v);
        }

        $this->wp->update_option('cgmcdt_mp3_tag_setttings', $settings);
        return $this->show();
    }

}