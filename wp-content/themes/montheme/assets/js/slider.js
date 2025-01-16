/**
 * Gère un slider d'images avec navigation dynamique (précédent/suivant)
 */
export const slider = {

  // Liste des images à afficher dans le slider
  imagesList: [
    "banniere.png",
    "banniere-3.jpg",
    "banniere-pate.jpg",
  ],


  // Index de l'image actuellement affichée
  currentImagePosition: 0,

  // Stocke les images générées dans le DOM
  generatedImages: [],

  init: function () {
    slider.generateImages();
    slider.bind();
  },

  bind: function () {
    const sliderButtons = document.querySelectorAll('.slider__btn');

    // Previous Button
    const previousButton = sliderButtons[0];
    previousButton.addEventListener("click", slider.handlePreviousSlide);

    //Next BUtton
    const nextButton = sliderButtons[1];
    nextButton.addEventListener("click", slider.handleNextSlide)


  },


  /**
 * Génère dynamiquement les images dans le DOM à partir de la liste des images
   */
  generateImages: function () {

    const sectionEl = document.querySelector('.homepage-slider');

    const fragment = document.createDocumentFragment();


    // parcours la liste des imgs pour les créer et les ajouter au fragment
    for (const sliderImage of slider.imagesList) {
      const imgEl = document.createElement('img');

      imgEl.src = sliderData.imagePath + sliderImage; // accede au chemin des images a l'aide
      imgEl.className = "slider__img";

      imgEl.alt = `Image de ${sliderImage}`;
      fragment.appendChild(imgEl);

      //stocker les imgs
      slider.generatedImages.push(imgEl)
    }

    // ajout des images au DOM en 1x
    sectionEl.appendChild(fragment);

    //selectionne la premiere image et lui ajoute la class current
    sectionEl.querySelector('.slider__img').classList.add('slider__img--current');
  },


  /**
   * Action sur le bouton precedent du slider
   */

  handlePreviousSlide: function () {

    //definir la position actuelle de l'image
    let newPosition;

    if (slider.currentImagePosition <= 0) {
      // revenir a la derniere img
      newPosition = slider.imagesList.length - 1

    } else {
      newPosition = slider.currentImagePosition - 1;

    }
    
    //afficher l'image precedente
    slider.goToSlide(newPosition);
  },


  /** 
   * met à jour l'image affichée en fonction de la position donnée
   * @param {number} newPosition - Index de l'image à afficher

/   */
  goToSlide: function (newPosition) {

    //retirer la class current
    for (const image of slider.generatedImages) {
      image.classList.remove('slider__img--current');
    }

    //ajouter la class current sur l'image qui convient
    slider.generatedImages[newPosition].classList.add("slider__img--current")
    

    slider.currentImagePosition = newPosition;

  },

  /**
   * Gestion de la slide suivante
   */
  handleNextSlide: function () {

    let newPosition;

    // Si l'image actuelle est la dernière, revenir à la première
    if (slider.currentImagePosition >= slider.imagesList.length - 1) {
      newPosition = 0;
    } else {
      newPosition = slider.currentImagePosition + 1;

    }
        slider.goToSlide(newPosition);
  },


}