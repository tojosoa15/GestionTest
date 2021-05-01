<?php

namespace App\Http\Controllers\Front;

use App\Models\Conditionnement;
use App\Models\Livraison;
use App\Models\Type_client;
use App\Repositories\CaracteristiqueRepository;
use App\Repositories\CaracteristiqueValeurRepository;
use App\Repositories\CategorieElementArchitectureRepository;
use App\Repositories\CategorieRepository;
use App\Repositories\CategorieSourceRepository;
use App\Repositories\Charge_beneficeRepository;
use App\Repositories\CommandeHasStatutCommandeRepository;
use App\Repositories\ConditionnementRepository;
use App\Repositories\ElementArchitectureRepository;
use App\Repositories\FormPageRepository;
use App\Repositories\FormRepository;
use App\Repositories\ImportExcelRepository;
use App\Repositories\LigneCommandeHasStatutLigneCommandeRepository;
use App\Repositories\LivraisonHasStatutLivraisonRepository;
use App\Repositories\LivraisonHasTaxeRepository;
use App\Repositories\LivraisonRepository;
use App\Repositories\LocalisationRepository;
use App\Repositories\MarqueProduitRepository;
use App\Repositories\MediathequeAutreRepository;
use App\Repositories\MediathequeRepository;
use App\Repositories\ModeFacturationRepository;
use App\Repositories\ModeTransportRepository;
use App\Repositories\Multi_langRepository;
use App\Repositories\PrixAchatProduitRepository;
use App\Repositories\PrixLivraisonRepository;
use App\Repositories\ProduitHasCaracteristiqueValeurRepository;
use App\Repositories\ProduitHasLocalRepository;
use App\Repositories\PromotionQuantiteManipulerRepository;
use App\Repositories\QuantiteDisponibleRepository;
use App\Repositories\QuantiteMinimaleRepository;
use App\Repositories\ReductionHasVariationQuantiteRepository;
use App\Repositories\RoleRepository;
use App\Repositories\TaxeRepository;
use App\Repositories\Type_localisationRepository;
use App\Repositories\Type_produitRepository;
use App\Repositories\Type_tauxRepository;
use App\Repositories\TypeConditionnementRepository;
use App\Repositories\TypeTransportRepository;
use App\Repositories\TypeTransporteurRepository;
use App\Repositories\TransitaireRepository;
use App\Repositories\TransporteurRepository;
use App\Repositories\UserRepository;
use App\Repositories\Type_fournisseurRepository;
use App\Repositories\Type_clientRepository;
use App\Repositories\FournisseurRepository;
use App\Repositories\ClientRepository;
use App\Repositories\PersonneRepository;
use App\Repositories\ValeurCategorieElementArchitectureRepository;
use App\Repositories\ProduitRepository;
use App\Repositories\VariationQuantiteRepository;
use App\Repositories\VolumeProduitRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LocalRepository;
use App\Repositories\AdresseRepository;
use App\Repositories\CommandeRepository;
use App\Repositories\LigneCommandeRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\TypeTaxeRepository;
use App\Repositories\QuantiteManipulerRepository;
use App\Repositories\TaxePaysRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Repositories\AdvisedPriceRepository;
use App\Repositories\ContactRepository;

class PrincipaleController extends Controller
{
    public $formRepository;
    public $formPageRepository;
    public function __construct()
    {
        $this->formRepository=new FormRepository();
        $this->formPageRepository=new FormPageRepository();
    }
    public function returnView($view)
    {


        return view($view);
    }
}
