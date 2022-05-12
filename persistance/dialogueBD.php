<?php
require_once 'connexion.php';
class DialogueBD
{
    public function getTousLesBiens()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT *
                    FROM bien bi JOIN agent ag
                    ON bi.IdAgent = ag.IdAgent JOIN TYPE_BIEN tb
                    ON bi.IdType = tb.IdType JOIN STATUT_BIEN st
                    ON bi.IdStatut = st.IdStatut";

            $sth = $conn->prepare($sql);
            $sth->execute();
            $listeBiens = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $listeBiens;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
            echo $erreur;
        }
    }

    public function getUnBien($idbien)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT *
                    FROM bien bi JOIN agent ag
                    ON bi.IdAgent = ag.IdAgent JOIN TYPE_BIEN tb
                    ON bi.IdType = tb.IdType JOIN STATUT_BIEN st
                    ON bi.IdStatut = st.IdStatut
                    WHERE IDBIEN = ?";

            $sth = $conn->prepare($sql);
            $sth->execute(array($idbien));
            $Unbien = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $Unbien;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
            echo $erreur;
        }
    }

    public function ModifBien($statut,$idbien)
    {
        $ajoutOK = false;
        try {
            $conn = Connexion::getConnexion();
            $sql = "UPDATE bien set IDSTATUT = ? WHERE IDBIEN = ?";
            $sthAjoutService = $conn->prepare($sql);
            $sthAjoutService->execute(array($statut,$idbien));
            $ajoutOK = true;
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage().'('.$e->getFile().',ligne'.$e->getLine().')';
            echo $msgErreur;
        }
        return $ajoutOK;
    }

    public function getTousLesClients()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM CLIENT";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $listeClients = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $listeClients;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
            echo $erreur;
        }
    }

    public function getTousLesAgent()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM agent";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $listeAgents = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $listeAgents;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
            echo $erreur;
        }
    }

    public function VerifConnexion($Utilisateur)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM agent WHERE IDAGENT = ? ";
            $sth = $conn->prepare($sql);
            $sth->execute(array($Utilisateur));
            $MonUtilisateur = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $MonUtilisateur;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
            echo $erreur;
        }
    }

    public function getTousLesType()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM type_bien";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $listeTypes = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $listeTypes;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
            echo $erreur;
        }
    }

    public function getTousLesStatut()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM statut_bien";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $listeStatuts = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $listeStatuts;
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
            echo $erreur;
        }
    }

    public function ajouterBien($id, $type, $statut, $agent, $ville, $adresse,$prix,$taille,$couverture)
    {
        $ajoutOK = false;
        try {
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO bien VALUES (?,?,?,?,?,?,?,?,?)";
            $sthAjoutService = $conn->prepare($sql);
            $sthAjoutService->execute(array($id, $type, $statut, $agent, $ville, $adresse,$prix,$taille,$couverture));
            $ajoutOK = true;
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage().'('.$e->getFile().',ligne'.$e->getLine().')';
            echo $msgErreur;
        }
        return $ajoutOK;
    }

    public function ajouterClient($id,$nom,$prenom,$num)
    {
        $ajoutOK = false;
        try {
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO client VALUES (?,?,?,?)";
            $sthAjoutService = $conn->prepare($sql);
            $sthAjoutService->execute(array($id,$nom,$prenom,$num));
            $ajoutOK = true;
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage().'('.$e->getFile().',ligne'.$e->getLine().')';
            echo $msgErreur;
        }
        return $ajoutOK;
    }

    public function ajouterVisite($idclient,$idbien)
    {
        $ajoutOK = false;
        try {
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO visiter VALUES (?,?)";
            $sthAjoutService = $conn->prepare($sql);
            $sthAjoutService->execute(array($idclient,$idbien));
            $ajoutOK = true;
        } catch (PDOException $e) {
            $msgErreur = $e->getMessage().'('.$e->getFile().',ligne'.$e->getLine().')';
            echo $msgErreur;
        }
        return $ajoutOK;
    }


}