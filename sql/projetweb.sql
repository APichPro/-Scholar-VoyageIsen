#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        mail           Varchar (250) NOT NULL ,
        nom            Varchar (250) NOT NULL ,
        prenom         Varchar (250) NOT NULL ,
        date_naissance Date NOT NULL ,
        mod_passe      Varchar (250) NOT NULL ,
        telephone      Varchar (30) NOT NULL ,
        adress         Text NOT NULL ,
        moderateur     TinyINT NOT NULL
	,CONSTRAINT utilisateur_PK PRIMARY KEY (mail)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: pays
#------------------------------------------------------------

CREATE TABLE pays(
        code_mc_pays Varchar (250) NOT NULL ,
        nom_pays     Varchar (250) NOT NULL
	,CONSTRAINT pays_PK PRIMARY KEY (code_mc_pays)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: voyage
#------------------------------------------------------------

CREATE TABLE voyage(
        id_voyage    Int  Auto_increment  NOT NULL ,
        Libelle      Varchar (250) NOT NULL ,
        description  Text NOT NULL ,
        duree        Int NOT NULL ,
        cout         Float NOT NULL ,
        image        Varchar (250) NOT NULL ,
        code_mc_pays Varchar (250) NOT NULL
	,CONSTRAINT voyage_PK PRIMARY KEY (id_voyage)

	,CONSTRAINT voyage_pays_FK FOREIGN KEY (code_mc_pays) REFERENCES pays(code_mc_pays)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: inscrit
#------------------------------------------------------------

CREATE TABLE inscrit(
        id_voyage   Int NOT NULL ,
        mail        Varchar (250) NOT NULL ,
        date_depart Date NOT NULL ,
        date_retour Date NOT NULL ,
        validation  Int NOT NULL
	,CONSTRAINT inscrit_PK PRIMARY KEY (id_voyage,mail)

	,CONSTRAINT inscrit_voyage_FK FOREIGN KEY (id_voyage) REFERENCES voyage(id_voyage)
	,CONSTRAINT inscrit_utilisateur0_FK FOREIGN KEY (mail) REFERENCES utilisateur(mail)
)ENGINE=InnoDB;

