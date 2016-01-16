<?php
require_once '../../../wp-load.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $dt = get_page_builder_options($_GET['id']);
    $data = $dt['thumbnails'];
    $images = $data['images'];
    $metas = $data['meta'];
    $sliders = array();
    if(count($images)){ 

        foreach($images as $k => $thumb_id) {
            $meta=  $metas[$k];
        	$thumb_image_url       = wp_get_attachment_image_src($thumb_id,'st_large');
        	$thumb_image_url       = $thumb_image_url[0];
        	$full_image_url        = wp_get_attachment_image_src($thumb_id,'full');
        	$full_image_url        = $full_image_url[0];
        	$thumbnail_image_url   = wp_get_attachment_image_src($thumb_id,'thumbnail');
        	$thumbnail_image_url   = $thumbnail_image_url[0];
        	$images['src_large'][]       = $thumb_image_url;
        	$images['src_thumbnail'][] = $thumbnail_image_url;
        	$images['title'][]     = stripslashes($meta['title']);
        	$images['caption'][]   = ($meta['caption']!='') ? '<p>'.stripslashes($meta['caption']).'</p>' : '';
        	$images['src_full'][]  = $full_image_url;
        }

    }   

$sCode = '';

$sTemplate = <<<XML
<img>
    <src>{fileurl}</src>
    <title>{title}</title>
    <caption>{album_title}</caption>
    <link>{link}</link>
    <target>{target}</target>
</img>
XML;

foreach ($images['src_large'] as $k => $v) {
    $sCode .= strtr($sTemplate, array('{fileurl}' => $v, '{title}' => '', '{album_title}' => '', '{link}' => '#', '{target}' => '_blank'));
}


header ('Content-Type: application/xml; charset=UTF-8');

echo <<<EOF
<?xml version="1.0" ?>
<bank>
    {$sCode}
</bank>
EOF;

die();

}
