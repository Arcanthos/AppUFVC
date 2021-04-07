const toggleSecondaryNav = () =>{
    const secondaryNavBtn = document.querySelector('#secondaryNavBtn');
    const secondaryNav = document.querySelector('#secondaryNav');
    const secondaryNavIcon = document.querySelector('#secondaryNavIcon');
    secondaryNavBtn.addEventListener('click', () =>{
        if (secondaryNav.classList.contains('hidden')){
            secondaryNav.classList.remove('hidden');
            secondaryNavIcon.classList.remove('fa-chevron-down');
            secondaryNavIcon.classList.add('fa-chevron-up');
        }else{
            secondaryNav.classList.add('hidden');
            secondaryNavIcon.classList.remove('fa-chevron-up');
            secondaryNavIcon.classList.add('fa-chevron-down');
        }
    })
}

toggleSecondaryNav();