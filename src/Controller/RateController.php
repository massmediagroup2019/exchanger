<?php

namespace App\Controller;

use App\Entity\Rate;
use App\Form\RateType;
use App\Service\ExchangeUpdater;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RateController
 * @package App\Controller
 */
class RateController extends AbstractController
{
    /**
     * @var string
     */
    private $defaultCurrency;

    /**
     * @var ExchangeUpdater
     */
    private $exchangeUpdater;

    /**
     * RateController constructor.
     * @param ExchangeUpdater $exchangeUpdater
     * @param string $defaultCurrency
     */
    public function __construct(ExchangeUpdater $exchangeUpdater, string $defaultCurrency)
    {
        $this->exchangeUpdater = $exchangeUpdater;
        $this->defaultCurrency = $defaultCurrency;
    }

    /**
     * @Route(name="rates_list", path="rates", methods={"GET"})
     * @Template("rates/index.html.twig")
     *
     * @return array
     */
    public function getRatesAction()
    {
        $rates = $this->getDoctrine()->getRepository(Rate::class)->findBy([], ['currency' => 'ASC']);
        $defaultCurrency = $this->defaultCurrency;
        $rateForm = $this->createForm(RateType::class);

        return compact('rates', 'defaultCurrency', 'rateForm');
    }

    /**
     * @Route(name="update_rates", path="update-rates", methods={"POST"}, options={"expose": true})
     * @return Response
     */
    public function updateRatesAction()
    {
        $this->exchangeUpdater->update();

        return new Response();
    }

    /**
     * @Route(name="change_rate", path="rate/{currency}/edit", methods={"POST"}, options={"expose": true})
     * @Template("rates/row.html.twig")
     *
     * @param Request $request
     * @param Rate $rate
     * @return Response
     */
    public function editRateAction(Request $request, Rate $rate)
    {
        $rate->setRate($request->request->get('rate') ?? 0);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($rate);
        $entityManager->flush();
        $defaultCurrency = $this->defaultCurrency;

        return compact('rate', 'defaultCurrency');
    }

    /**
     * @Route(name="create_rate", path="rate/create", methods={"GET", "POST"}, options={"expose": true})
     * @Template("rates/form.html.twig")
     *
     * @param Request $request
     * @return RedirectResponse|array
     */
    public function createRateAction(Request $request)
    {
        $rate = new Rate();
        $rateForm = $this->createForm(RateType::class, $rate);
        $rateForm->handleRequest($request);

        if ($rateForm->isSubmitted() && $rateForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rate);
            $entityManager->flush();
            return $this->redirectToRoute('rates_list');
        }

        return ['form' => $rateForm->createView()];
    }

    /**
     * @Route(name="delete_rate", path="delete-rate/{currency}", methods={"DELETE"}, options={"expose": true})
     *
     * @param Rate $rate
     * @return Response
     */
    public function deleteRateAction(Rate $rate)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($rate);
        $entityManager->flush();

        return new Response();
    }
}
