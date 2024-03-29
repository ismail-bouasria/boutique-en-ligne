document.addEventListener("DOMContentLoaded", (event) => {


    const searchBar = document.getElementById('search');
    const form = document.getElementById('formsearch');

    searchBar.addEventListener('input', () => {

        fetch('../classes/Search.php?search=' + searchBar.value + '')
            .then((response) => response.json())
            .then((response) => {
                // console.log(response)=

                //Première condition si la barre de recherche est vide ou pas 
                if (searchBar.value != '') {
                    let removeableDiv = document.getElementById('divContent');

                    if (removeableDiv != null) {
                        removeableDiv.remove();
                    }

                    //creation de l'élément div pour ajouter mes lien produit
                    let searchDiv = document.createElement('div'),
                        searchContainer = document.querySelector('#searchContainer');
                    //leur donne un id 
                    searchDiv.id = "divContent";

                    function textHTML(str) {
                        var text = document.createElement('textarea');
                        text.innerHTML = str;
                        return text.value;
                    }


                    response.forEach(element => {
                        var span = document.createElement('span'),
                            a = document.createElement('a'),
                            img = document.createElement('img');

                        a.href = "./page-produit.php?produit=" + element.id;
                        img.src = element.image;
                        span.classList.add('spanSearch');
                        a.innerHTML = element.nom
                        span.append(img);
                        span.append(a)
                        searchDiv.append(span)



                    });
                    searchContainer.append(searchDiv);

                }
                else // si la bar est vide 
                {
                    let removeableDiv = document.getElementById('divContent');

                    //vérifier si la barre de recherche est vide mais qu'il y a eu une div créé au préalable
                    if (removeableDiv != null) {
                        removeableDiv.remove();
                    }
                }

            })
            .catch((error) => {
                console.log(error)
            })

    });


});