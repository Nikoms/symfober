<?php
/**
 * Created by PhpStorm.
 * User: Nikoms
 * Date: 4/04/14
 * Time: 0:30
 */

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DynamicPageController extends Controller{

    public function pageAction(Request $request){
        return new Response('<html><body>'.__METHOD__.' <br />' . $request->get('_route') . '</body></html>');
    }

} 