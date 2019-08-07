<?php

namespace App\Controller;

use App\Entity\Goods;
use App\Repository\GoodsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class GoodsController extends AbstractController
{

    /**
     * @Route("/", name="goods_list")
     */
    public function goodsList() {
        $repository = $this
            ->getDoctrine()
            ->getRepository(Goods::class);
        $goods = $repository->findAll();

        return $this->render(
            'goods/list.html.twig',
            ["goods" => $goods]
        );
    }



    /**
     * @Route("/goods", name="goods")
     */
    public function index()
    {
        return $this->render('goods/index.html.twig', [
            'controller_name' => 'GoodsController',
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN_USER")
     * @Route("/goods/create", name="goods_create")
     *
     */
    public function createGoods(Request $request)
    {
        $goods = new Goods();
        $form = $this
            ->createFormBuilder($goods)
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Название товара',
                'attr' => [
                    'placeholder' => 'Товар номер 1'
                ]
            ])
            ->add('description',  TextType::class, [
                'required' => true,
                'label' => 'Описание товара',
                'attr' => [
                    'placeholder' => 'Описание, характеристики и т.д.'
                ]
            ])
            ->add('price', MoneyType::class,[
                'required' => true,
                'label' => 'Стоимость товара',
                'attr' => [
                    'placeholder' => '999999'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => "Сохранить"
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($goods);
            $manager->flush();
            return new RedirectResponse('/');
        }



        return $this->render(
            'goods/create.html.twig',
            ["form" => $form->createView()]
        );
    }
}
