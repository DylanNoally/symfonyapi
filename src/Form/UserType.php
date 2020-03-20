<?php
namespace App\Form;

use App\Entity\User;
use App\Entity\Roles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('email', EmailType::class, ['label' => 'E-mail', 'required' => true])
            ->add('password', PasswordType::class, ['label' => 'Mot de passe', 'required' => true])
    		->add('nom', TextType::class, array('label' => 'Nom'))
    		->add('prenom', TextType::class,  array('label' => 'Prénom'))            
    		->add('genre', ChoiceType::class, array('choices' => array('Homme'=>0, 'Femme'=>1)))
    		->add('date_de_naissance', DateType::class,  array('label' => 'Date de naissance', 'widget' => 'single_text', 'required' => false)) 
			->add('photo', FileType::class, ['label' => 'Photo', 'required' => false,
				'data_class' => null])
    		->add('tel_mobile', TelType::class, array('label' => 'Tel. Mobile', 'required' => false))
    		->add('tel_fixe', TelType::class, array('label' => 'Tel. Fixe direct', 'required' => false))
    		->add('poste', TextType::class,  array('label' => 'Poste', 'required' => false))
/*            ->add('id_role', EntityType::class, array('class' => Roles::class, 'choice_label' => 'libelle', 'label'=>'Rôle ', 'placeholder'=>'', 'required' => false))*/                 					

            // Bouton Submit //
            ->add('save', SubmitType::class, array('label' => 'ENREGISTRER'))->getForm();
	}
}
?>
