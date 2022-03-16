<?php
    header("Content-Type: application/json;charset=utf-8");
    header('Access-Control-Allow-Origin: *');

    $xml = simplexml_load_file('http://www.ign.es/ign/RssTools/sismologia.xml');

    $result = array();

    foreach ($xml->channel->item as $item) {
        $ar = array();

        $title = $item->title;

        $title = str_replace("-Info.terremoto: ", "", $title);

        $ar["date"] = substr($title, 0, 10);
        $ar["time"] = substr($title, 11);

        $ar["link"] = (string)$item->link;

        $desc = (string)$item->desc;
        $ar["description"] = $desc;

        $ar["magnitude"] = substr($desc, strpos($desc, "magnitud") + 9, 3);
        $loc = substr($desc, strpos($desc, "en") + 3);
        $loc = substr($loc, 0, strpos($loc, "en") - 1);
        $ar["location"] = $loc;

        // namespace geo
        $ns_geo = $item->children('http://www.w3.org/2003/01/geo/wgs84_pos#');
        $ar["lat"] = (string)$ns_geo->lat;
        $ar["long"] = (string)$ns_geo->long;

        $result[] = $ar;
    }

    echo json_encode($result);
