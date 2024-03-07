<?php

	function getCode( $produit ){
		list( $code , $nom , $prixUnit , $promo ) = explode( ":" , $produit ) ;
		return $code ;
	}
	
	function getNom( $produit ){
		list( $code , $nom , $prixUnit , $promo ) = explode( ":" , $produit ) ;
		return $nom ;
	}
	
	function getPrixUnitaire( $produit ){
		list( $code , $nom , $prixUnit , $promo ) = explode( ":" , $produit ) ;
		return $prixUnit ;
	}
	
	function getPromotion( $produit ){
		list( $code , $nom , $prixUnit , $promo ) = explode( ":" , $produit ) ;
		return $promo ;
	}

	function estEnPromo( $produit ){
		list( $code , $nom , $prixUnit , $promo ) = explode( ":" , $produit ) ;
		
		if( $promo == 0 ){
			return FALSE ;
		}
		else {
			return TRUE ;
		}
	}
	
	function estUnPetitPrix( $produit , $petitPrix ){
		list( $code , $nom , $prixUnit , $promo ) = explode( ":" , $produit ) ;
		
		if( $prixUnit <= $petitPrix ){
			return TRUE ;
		}
		else {
			return FALSE ;
		}
	}

	function calculerPrixPromo( $produit ){
		
		return getPrixUnitaire( $produit ) - ( getPrixUnitaire( $produit ) * getPromotion( $produit ) / 100 ) ;
	}
	
	function getProduitEnChaine( $produit ){
		list( $code , $nom , $prixUnit , $promo ) = explode( ":" , $produit ) ;
		return "\n[$code] $nom\n\tPrix  : $prixUnit €\n\tPromo : $promo %\n" ;
	}
	
	
	// Exercice 1
	function visualiserProduits(){
		global $produits ;
		
		foreach( $produits as $unProduit ){
			echo getProduitEnChaine( $unProduit ) ;
		}
	}
	
	// Exercice 2
	function visualiserProduitsEnPromo(){
		global $produits ;
		
		foreach( $produits as $unProduit ){
			echo getProduitEnChaine( $unProduit ) ;
			if( estEnPromo( $unProduit ) == TRUE ){
				echo "\tPrix promo : ", calculerPrixPromo( $unProduit ), " € \n"; 
			} 
		} 
	}
	
	// Exercice 3
	function getPromoMax(){
		global $produits ;
		
		$promoMax = 0 ;
		
		foreach( $produits as $unProduit ){
			
			if( estEnPromo( $unProduit ) == TRUE ){
				$promo = getPromotion( $unProduit ) ;
				if( $promo > $promoMax){
					$promoMax = $promo ; 
				}
				
				// Votre code ici
				// Si la promotion courante est supérieure à celle mémorisée dans la variable $promoMax, 
				// la variable $promoMax doit-être valorisée avec la promotion courante
				
			}
		}
		
		return $promoMax ;
	}
	
	// Exercice 4
	function getPromoMin(){
		global $produits ; 
		
		$promoMin = 0 ; 
		
		foreach( $produits as $unProduit ){
			
			if( estEnPromo( $unProduit ) == TRUE ){
				$promo = getPromotion( $unProduit ) ;
				if ( $promo < $promoMin ){
					$promoMin = $promo ; 
				}
			}
		}
		return $promoMin ; 		
	}
	
	// Exercice 5
	function calculerMoyennePromos(){
		global $produits ;
		
		$totalPromos = 0 ;
		$nbPromos = 0 ;
		
		foreach( $produits as $unProduit ){
			
			if( estEnPromo( $unProduit ) == TRUE ){
				$promo = getPromotion( $unProduit ) ;
				$nbPromos += 1 ; 
				$totalPromos += $promo ; 
				
				
				// Votre code ici
				// Cumuler le montant de la promotion
				// et prendre en compte cette nouvelle promotion
			}
		}
		
		return $totalPromos / $nbPromos ;
	}
	
	// Exercice 6
	function getProduit( $code ){
		global $produits ;
		
		$leProduit = "" ;
		$i = 0 ;
		
		while( $i < count( $produits ) && $leProduit == "" ){
			if( getCode( $produits[ $i ] ) == $code ){
				$leProduit = $produits[ $i ] ;
			}
			else {
				$i = $i + 1 ;
			}
		}
		
		return $leProduit ;
	}
	
	// Exercice 7
	function annulerToutesLesPromos(){
		global $produits ;
		
		for( $i = 0 ; $i < count( $produits ) ; $i = $i + 1 ){
			$code = getCode( $produits[ $i ] ) ;
			$nom = getNom( $produits[ $i ] ) ;
			$prix = getPrixUnitaire( $produits[ $i ] ) ;
			
			$produits[ $i ] = implode( ":" , array( $code , $nom , $prix , 0 ) ) ;
		}
	}
	
	// Exercice 8
	function appliquerMemePromoTousProduits( $promo ){
		global $produits ;
		
		for( $i = 0 ; $i < count( $produits ) ; $i = $i + 1 ){
			$code = getCode( $produits[ $i ] ) ;
			$nom = getNom( $produits[ $i ] ) ;
			$prix = getPrixUnitaire( $produits[ $i ] ) ;
			
			$produits[ $i ] = implode( ":" , array( $code , $nom , $prix , $promo ) ) ;
		}
		
	}
	
	// Fonction utilisée dans l'exercice 9
	function getIndiceProduit( $code ){
		global $produits ;
		
		$indice = -1 ;
		$i = 0 ;
		
		while( $i < count( $produits ) && $indice == -1 ){
			if( getCode( $produits[ $i ] ) == $code ){
				$indice = $i ;
			}
			else {
				$i = $i + 1 ;
			}
		}
		
		return $indice ;
	}
	
	
	// Exercice 9
	function appliquerPromoProduit( $code , $promo ){
		global $produits ;
		
		$ind = getIndiceProduit( $code ) ;
		
		if( $ind != -1 ){
			$code = getCode( $produits[ $ind ] ) ;
			$nom = getNom( $produits[ $ind ] ) ;
			$prix = getPrixUnitaire( $produits[ $ind ] ) ;
			
			$produits[ $ind ] = implode( ":" , array( $code , $nom , $prix , $promo ) ) ;
			}
		}

	
	
	# Fonction principale
	function mainTest(){
		
		global $produits ;
		
		$produits = Array(
				"178:Dentifrice à la fraise:15:10" ,
				"179:Dentifrice au sel marin:8.9:0" ,
				"181:Dentifrice au citron vert:10.9:5" ,
				"182:Dentifrice à l'orange:12:0" ,
				"201:Crème hydratante à l'huile d'avocat:20.5:0" ,
				"202:Crème hydratante à l'huile d'argan:19.3:20" ,
				"203:Crème hydratante à l'huile de coco:17.3:10" ,
				"204:Crème de nuit relaxante:21.7:50" ,
				"210:Crème de jour parfumée au jasmin:37.5:30"
			) ;
		
		
		// Exercice 1
		echo "\n1) Liste des produits :\n\n" ;
	
		visualiserProduits() ; 
		
		// Exercice 2
		echo "\n2) Liste des produits en promo :\n\n" ;
		
		visualiserProduitsEnPromo() ;
	
		
		// Exercice 3
		echo "\n3) Promotion max :\n\n" ;
		echo getPromoMax() , " %\n" ;
		
		
		// Exercice 4
		echo "\n4) Promotion min :\n\n" ;
		echo getPromoMin() , " %\n" ;
	
		
		// Exercice 5
		echo "\n5) Moyenne des promotions :\n\n" ;
		echo calculerMoyennePromos() , " %\n" ;
	
	
		// Exercice 6
		echo "\n6) Recherche d'un produit par son code :\n\n" ;
		
		echo "Produit 179 :\n\t" ;
		$leProduit = getProduit( 179 ) ;
		echo "\t", getProduitEnChaine($leProduit), "\n" ; 
		
		echo "Produit 318 :\n\t" ;
		$leProduit = getProduit( 318 ) ;
		if( $leProduit == "" ){
			echo "Produit inconnu\n" ; 
		}
		
		
		// Exercice 7
		echo "\n7) Annuler toutes les promotions :\n\n" ;
		annulerToutesLesPromos() ; 
		visualiserProduits() ; 
		
		
		// Exercice 8
		echo "\n8) Appliquer une promotion de 10 % à tous les produits :\n\n" ;
		appliquerMemePromoTousProduits( 10 ) ;
		visualiserProduits() ;
		
		
		// Exercice 9
		echo "\n9) Appliquer une promotion de 30 % au produit 210 :\n\n" ;
		appliquerPromoProduit( 210 , 30 ) ;
		visualiserProduits() ;
		
	}
	
	# Programme Principal
	mainTest() ;

?>
