
<div class='close_modal' id='close_modal'>X</div>
<div class='modal_serie'>
    <div class='modal_serie_detail'>
        <span>Titre de la série :</span><span><?=$serie["name"]?></span>
        <span>Date de sortie :</span>   <span><?=$serie["launchYear"]?></span>
        <span>Pays d'origine :</span>   <span><?=$serie["country"]?></span>
        <span>Diffusion sur :</span>    <span><?=$serie["availableOn"]?></span>
        <span>Genres :</span>           <span><?=implode(", ",$serie["styles"])?></span>
        <span>Créé par :</span>         <span><?=implode(", ",$serie["createdBy"])?></span>
        <span>Acteurs :</span>          <span><?=implode(", ",$serie["actors"])?></span>
        <span>Durée :</span>            <span><?=$serie["episodeDurationInMinutes"]?></span>
        <span>Saisons :</span>          <span><?=$serie["numberOfSeasons"]?></span>
        <span>Diffusion :</span>        <span><?=(($serie["ongoing"]) ? "En cours" : "Terminée")?></span>
        <span>Lien vers affiche :</span><span><a href='".$serie["image"]."' target='_blank'><?=$serie["image"]?></a></span>
    </div>
</div>
