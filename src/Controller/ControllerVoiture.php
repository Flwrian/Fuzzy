<?php

namespace App\Covoiturage\Controller;

use App\Covoiturage\Model\DataObject\Voiture;
use App\Covoiturage\Model\Repository\VoitureRepository;

class ControllerVoiture {

    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../view/$cheminVue"; // Charge la vue
     }

    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function readAll() : void {
        $voitures = VoitureRepository::getVoitures(); //appel au modèle pour gerer la BD
        static::afficheVue('view.php', ['voitures' => $voitures, 'pagetitle' => 'Liste des voitures', 'cheminVueBody' => 'voiture/list.php']);
    }

    public static function read() : void {
        $voitures = VoitureRepository::getVoitureParImmat($_GET['immat']);
        if($voitures == null) {
            static::afficheVue('view.php', ['pagetitle' => 'Erreur', 'cheminVueBody' => 'voiture/error.php']);
        }
        else{
            static::afficheVue('view.php', ['voitures' => $voitures, 'pagetitle' => 'Détail de la voiture', 'cheminVueBody' => 'voiture/detail.php']);
        }
    }

    public static function create() : void {
        static::afficheVue('view.php', ['pagetitle' => 'Création de la voiture', 'cheminVueBody' => 'voiture/create.php']);
    }

    public static function created() : void {
        $immat = $_GET['immat_id'];
        $immat = htmlspecialchars($immat);
        $marque = $_GET['marque_id'];
        $marque = htmlspecialchars($marque);
        $couleur = $_GET['couleur_id'];
        $couleur = htmlspecialchars($couleur);
        $nbSieges = $_GET['nbSieges_id'];
        $nbSieges = htmlspecialchars($nbSieges);

        $voiture = new Voiture($immat, $marque, $couleur, $nbSieges);
        VoitureRepository::sauvegarder($voiture);
        $voitures = VoitureRepository::getVoitures();
        
        // On affiche la vue created en passant le tableau $voitures car la vue created affiche la liste des voitures. Il faut aussi passer les autres paramètres de la vue view.php.
        static::afficheVue('view.php', ['voiture' => $voiture, 'pagetitle' => 'Voiture créee', 'cheminVueBody' => 'voiture/created.php', 'voitures' => $voitures]);
    }

    public static function delete() : void {
        $immat = $_GET['immat_id'];
        $immat = htmlspecialchars($immat);
        $voiture = VoitureRepository::getVoitureParImmat($immat);
        VoitureRepository::supprimerParImmatriculation($voiture->getImmatriculation());
        $voitures = VoitureRepository::getVoitures();
        static::afficheVue('view.php', ['voiture' => $voiture, 'pagetitle' => 'Voiture supprimée', 'cheminVueBody' => 'voiture/deleted.php', 'voitures' => $voitures]);
    }

    public static function error(string $errorMessage = "") : void {
        static::afficheVue('view.php', ['pagetitle' => 'Problème avec la voiture', 'cheminVueBody' => 'voiture/error.php', 'errorMessage' => $errorMessage]);
    }
}
?>