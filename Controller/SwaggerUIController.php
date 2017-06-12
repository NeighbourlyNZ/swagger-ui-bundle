<?php

namespace Ideahq\Bundle\SwaggerUIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Bez Hermoso <bez@activelamp.com>
 */
class SwaggerUIController extends Controller
{
    public function indexAction(Request $request)
    {
        $docUrl = $this->get('service_container')->getParameter('ideahq_swagger_ui.url');
        $validatorUrl = $this->get('service_container')->getParameter('ideahq_swagger_ui.validator_url');
        $operationsSorter = $this->get('service_container')->getParameter('ideahq_swagger_ui.operations_sorter');

        if (preg_match('/^(https?:)?\/\//', $docUrl)) {
            // If https://..., http://..., or //...
            $url = $docUrl;
        } elseif (strpos($docUrl, '/') === 0) {
            //If starts with "/", interpret as an asset.
            $url = $this->get('templating.helper.assets')->getUrl($docUrl);
        } else {
            // else, interpret as route-name.
            $url = $this->generateUrl($docUrl);
        }

        $url = rtrim($url, '/');

        return $this->render('IdeahqSwaggerUIBundle:SwaggerUI:index.html.twig', array(
            'url' => $url,
            'validator_url' => $validatorUrl,
            'operations_sorter' => $operationsSorter
        ));
    }
}
