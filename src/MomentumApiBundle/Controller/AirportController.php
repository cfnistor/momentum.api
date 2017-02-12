<?php

namespace MomentumApiBundle\Controller;

use MomentumApiBundle\Entity\Airport;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
/**
 * Rest controller for airports
 *
 * @package AppBundle\Controller
 * @author Cristian Nistor <cfnistor@gmail.com>
 */
class AirportController extends FOSRestController
{

    /**
     * Alphabetical listing of all airports.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing airports.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many airports to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getAirportsAction(ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');

        $airports = $this->getDoctrine()->getRepository('MomentumApiBundle:Airport')
            ->findBy(array(), array('name' => 'asc'), $limit, $offset);

        return $airports;
    }
}