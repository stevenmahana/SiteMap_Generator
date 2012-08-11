<?php
/**
 * Site Map Generator Script
 * This is a basic representations of the script I use to generate millions of links in my site maps
 *
 * Version 0.1.0
 * Date 2012/07/26
 *
 * LICENSE: This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software Foundation,
 * either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * @category   XML Site Map Generator
 * @package    XML Site Map Generator
 * @author     Steve Mahana <StevenMahana@gmail.com>
 * @copyright  2012-2015 Steven Mahana
 * @license    http://www.gnu.org/licenses/gpl-3.0.html  LGPL License 3.0
 * @version    GIT: $Id$
 * @link       https://github.com/stevenmahana
 * @see        N/A
 * @since      N/A
 * @deprecated N/A
 *
 * Dependencies:  XSL Files, Data Files
 *
 * Rules: 50,000 links per page in site map / 1,000 images per page 
 * Find / Replace WEBSITE with your domain 
 *
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);//^ E_NOTICE ^ E_WARNING

require('data/data.php'); // simulates database


/*
 * Map Index (sitemapindex.xml) generator
 */

$feed = '<?xml version="1.0" encoding="UTF-8"?>';

$feed .= '<?xml-stylesheet type="text/xsl" href="css/sitemapindex.xsl"?>';

$feed .= '<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
 xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
 xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

$feed .= '<sitemap>';
$feed .= '<loc>http://WEBSITE.com/sitemap/site.xml</loc>';
$feed .= '<lastmod>'.date(DATE_ATOM).'</lastmod>';
$feed .= '</sitemap>';
$feed .= '<sitemap>';
$feed .= '<loc>http://WEBSITE.com/sitemap/pages.xml</loc>';
$feed .= '<lastmod>'.date(DATE_ATOM).'</lastmod>';
$feed .= '</sitemap>';
$feed .= '<sitemap>';
$feed .= '<loc>http://WEBSITE.com/sitemap/taxonomy_category.xml</loc>';
$feed .= '<lastmod>'.date(DATE_ATOM).'</lastmod>';
$feed .= '</sitemap>';
$feed .= '<sitemap>';
$feed .= '<loc>http://WEBSITE.com/sitemap/imagesitemap.xml</loc>';
$feed .= '<lastmod>'.date(DATE_ATOM).'</lastmod>';
$feed .= '</sitemap>';
$feed .= '<sitemap>';
$feed .= '<loc>http://WEBSITE.com/sitemap/products.xml</loc>';
$feed .= '<lastmod>'.date(DATE_ATOM).'</lastmod>';
$feed .= '</sitemap>';
$feed .= '</sitemapindex>';


$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($feed);
$dom->formatOutput = TRUE;
$dom->save('sitemapindex.xml');
/*
 * Map Index (sitemapindex.xml) generator
 */

echo '<p>Site Index Map Done ... <a href="sitemapindex.xml">sitemapindex.xml</a></p>';

/*
 * Site Map (site.xml) generator
 */
$feed = '<?xml version="1.0" encoding="UTF-8"?>';

$feed .= '<?xml-stylesheet type="text/xsl" href="css/sitemap.xsl"?>';

$feed .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
 xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
 xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

$feed .= '<url>';
$feed .= '<loc>http://WEBSITE.com/</loc>';
$feed .= '<lastmod>'.date(DATE_ATOM).'</lastmod>';
$feed .= '<changefreq>hourly</changefreq>';
$feed .= '<priority>1.0</priority>';
$feed .= '</url>';
$feed .= '</urlset>';


$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($feed);
$dom->formatOutput = TRUE;
$dom->save('site.xml');
/*
 * Site Map (site.xml) generator
 */

echo '<p>Site Map Done ... <a href="site.xml">site.xml</a></p>';

/*
 * Page Map (pages.xml) generator
 */

$results = Data::pages();

$feed = '<?xml version="1.0" encoding="UTF-8"?>';
$feed .= '<?xml-stylesheet type="text/xsl" href="css/sitemap.xsl"?>';

$feed .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
 xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
 xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

foreach($results as $v):
    $feed .= '<url>';
    $feed .= '<loc>http://WEBSITE.com/'.$v.'/</loc>';
    $feed .= '<lastmod>'.date(DATE_ATOM).'</lastmod>';
    $feed .= '<changefreq>monthly</changefreq>';
    $feed .= '<priority>0.4</priority>';
    $feed .= '</url>';
endforeach;

$feed .= '</urlset>';

$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($feed);
$dom->formatOutput = TRUE;
$dom->save('pages.xml');

/*
 * Page Map (pages.xml) generator
 */

echo '<p>Page Map Done ... <a href="pages.xml">pages.xml</a></p>';

/*
 * Taxonomy Category Map (taxonomy_category.xml ) generator
 */
$man= Data::taxonomy_man();
$cat = Data::taxonomy_cat();

$feed = '<?xml version="1.0" encoding="UTF-8"?>';

$feed .= '<?xml-stylesheet type="text/xsl" href="css/sitemap_taxonomy.xsl"?>';

$feed .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
 xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
 xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';


foreach($cat as $v):
    $feed .= '<url>';
    $feed .= '<loc>http://WEBSITE.com/'.$v.'/</loc>';
    $feed .= '<lastmod>'.date(DATE_ATOM).'</lastmod>';
    $feed .= '<changefreq>always</changefreq>';
    $feed .= '<priority>1.0</priority>';
    $feed .= '</url>';
    
    foreach($man as $val):

        $feed .= '<url>';
        $feed .= '<loc>http://WEBSITE.com/'.$v.'/'.$val.'/</loc>';
        $feed .= '<lastmod>'.date(DATE_ATOM).'</lastmod>';
        $feed .= '<changefreq>always</changefreq>';
        $feed .= '<priority>1.0</priority>';
        $feed .= '</url>';       

    endforeach;    
    
    
endforeach;

$feed .= '</urlset>';

$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($feed);
$dom->formatOutput = TRUE;
$dom->save('taxonomy_category.xml');

/*
 * Taxonomy Category Map (taxonomy_category.xml ) generator
 */

echo '<p>Taxonomy Map Done ... <a href="taxonomy_category.xml">taxonomy_category.xml</a></p>';

/*
 * Products Map (products.xml) generator
 */

$man = Data::build_product();

$feed = '<?xml version="1.0" encoding="UTF-8"?>';

$feed .= '<?xml-stylesheet type="text/xsl" href="css/sitemap_taxonomy.xsl"?>';

$feed .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
 xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
 xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';


foreach($man as $v):
    $feed .= '<url>';
    $feed .= '<loc>http://WEBSITE.com/'.$v.'/</loc>';
    $feed .= '<lastmod>'.date(DATE_ATOM).'</lastmod>';
    $feed .= '<changefreq>always</changefreq>';
    $feed .= '<priority>1.0</priority>';
    $feed .= '</url>';   
    
endforeach;

$feed .= '</urlset>';

$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($feed);
$dom->formatOutput = TRUE;
$dom->save('products.xml');

/*
 * Products Map (products.xml) generator
 */

echo '<p>Products Map Done ... <a href="products.xml">products.xml</a></p>';
?>
