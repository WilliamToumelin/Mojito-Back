
const addFormToCollection = (e) => {
  const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

  const item = document.createElement('li');

  item.innerHTML = collectionHolder
    .dataset
    .prototype
    .replace(
      /__name__/g,
      collectionHolder.dataset.index
    );

  collectionHolder.appendChild(item);


  collectionHolder.dataset.index++;

  addTagFormDeleteLink(item);
};


const addTagFormDeleteLink = (item) => {
  const removeFormButton = document.createElement('button');
  removeFormButton.innerText = 'Supprimer';

  item.append(removeFormButton);
  

  removeFormButton.addEventListener('click', (e) => {
      e.preventDefault();
      // remove the li for the tag form
      item.remove();
  });
};


document
.querySelectorAll('.add_item_link')
.forEach(btn => {
    btn.addEventListener("click", addFormToCollection)
});

document
  .querySelectorAll('ul.steps li')
  .forEach((step) => {
      addTagFormDeleteLink(step)
  })

  document
  .querySelectorAll('ul.cocktailuses li')
  .forEach((cocktailuses) => {
      addTagFormDeleteLink(cocktailuses)
  })


  /*********************/


    const ingredientList = document.querySelectorAll('.form-container-ingredient');
    const deleteButtonsIngredient = document.querySelectorAll('.button-delete-ingredient');

    for (let index = 0; index < deleteButtonsIngredient.length; index++) {
      deleteButtonsIngredient[index].addEventListener("click", function (e) {
        e.preventDefault();
        deleteButtonsIngredient[index].remove();
        ingredientList[index].remove();
      }
    )};

    /*********************/

   const deleteButtonsStep = document.querySelectorAll('.button-delete-step');
    const stepList = document.querySelectorAll('.form-container-step');

    for (let index = 0; index < deleteButtonsStep.length; index++) {
      deleteButtonsStep[index].addEventListener("click", function (e) {
        e.preventDefault();
        deleteButtonsStep[index].remove();
        stepList[index].remove();
      }
    )};

  



