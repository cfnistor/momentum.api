<?php


namespace MomentumApiBundle\Controller;

use MomentumApiBundle\Entity\Airport;
use MomentumApiBundle\Entity\Flight;
use MomentumApiBundle\Form\FlightType;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Rest controller for flights
 *
 * @package MomentumApiBundle\Controller
 * @author Cristian Nistor <cfnistor@gmail.com>
 */
class FlightController extends FOSRestController
{

    /**
     * Removes a flight.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     204="Returned when successful"
     *   }
     * )
     *
     * @param int $id the note id
     *
     * @return array
     */
    public function deleteFlightAction($id)
    {
        $flight = $this->_getFlight($id);
        if (!$flight instanceof Flight) {
            throw $this->createNotFoundException('Unable to find flight');
        }

        $em = $this->getDoctrine()->getManager();

	try {
            $em->remove($flight);
            $em->flush();
        } catch (Exception $e) {
             throw new HttpException(409, "This flight cannot be deleted now, please try again later.");
             exit;
        }
        $message = sprintf('Flight %d has been deleted', $id);
        
        return array('message' => $message);

    }

    /**
     * Get a single flight.
     *
     * @ApiDoc(
     *   output = "MomentumApiBundle\Entity\Flight",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the note is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="flight")
     *
     * @param int $id the flight id
     *
     * @return array
     *
     * @throws NotFoundHttpException when flight not exist
     */
    public function getFlightAction($id)
    {
        $flight = $this->_getFlight($id);
        if (!$flight instanceof Flight) {
            throw $this->createNotFoundException('Unable to find flight');
        }

        return array('flight' => $flight);
    }

    /**
     * Add a new flight from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "MomentumApiBundle\Form\FlightType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *   template = "MomentumApiBundle:Flight:newFlight.html.twig",
     *   statusCode = Response::HTTP_BAD_REQUEST
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface[]|View
     */
    public function postFlightAction(Request $request)
    {
        $flight = new Flight();
        $form = $this->createForm(new FlightType(), $flight);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($flight);
            $em->flush();

            return array('flight' => $flight);
        }

        return array('form' => $form);
    }

    /**
     * List of flights for a trip
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when bad request"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="departure_id", requirements="\d+", nullable=false, description="Id of departure Airport")
     * @Annotations\QueryParam(name="destination_id", requirements="\d+", nullable=false, description="Id if destination airport")
     *
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getFlightsAction(ParamFetcherInterface $paramFetcher)
    {
        $departureId = $paramFetcher->get('departure_id');
        $destinationId = $paramFetcher->get('destination_id');
        $searchCriteria = array(
            'departureAirport' => $departureId,
            'destinationAirport' => $destinationId
        );

        $flights = $this->getDoctrine()->getRepository('MomentumApiBundle:Flight')
            ->findBy($searchCriteria, null, null, null);

        return $flights;
    }

    /**
     * Returns a flight
     *
     * @param int $id
     */
    private function _getFlight($id)
    {
        $em = $this->getDoctrine()->getManager();
        $flight = $em->getRepository('MomentumApiBundle:Flight')->find($id);

        return $flight;
    }
}
