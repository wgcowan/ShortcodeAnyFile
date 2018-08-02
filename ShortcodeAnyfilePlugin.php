<?php

class ShortcodeAnyfilePlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array('public_head');

    public function setUp()
    {
        add_shortcode('anyfile', array('ShortcodeAnyfilePlugin', 'anyfile'));
        parent::setUp();
    }

    public function hookPublicHead($args)
    {
 		/**queue_css_file('jquery.fancybox');
		queue_css_file('jquery.fancybox-buttons');
		queue_js_file('jquery.fancybox.pack');
	    queue_js_file('jquery.fancybox-buttons');
		**/
    }

	/**
     * Build HTML for the carousel
     * @param array $args
     * @param Zend_View $view
     * @return string HTML to display
     */
    public static function anyfile($args, $view)
    {
        static $id_suffix = 0;
       
        if (isset($args['id'])) {
            $params['range'] = $args['id'];
        }

        if (isset($args['width'])) {
            $params['width'] = $args['width'];
        }

        if (isset($args['height'])) {
            $params['height'] = $args['height'];
        }
		
        if (isset($args['img'])) {
            $params['img'] = $args['img'];
        }

		$params['hasImage'] = 1;
		$id = explode(',',$args['id']);
	
       	$file = get_record_by_id('File', $args['id']);

        $html = $view->partial('show_file.php', array('file' => $file, 'lid'=>$params['range'], 'id_suffix' => $id_suffix, 'params' => $args));
        $id_suffix++;
        return $html;
    }
}
