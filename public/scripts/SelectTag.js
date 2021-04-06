const SelectTag = () =>{
    const tags = document.querySelectorAll('.tagBtn');
    const tagInput = document.querySelector('#ressource_tags');
    const tagTable = [];

    tags.forEach( tag =>{
        tag.addEventListener('click', ()=>{
            if (tag.classList.contains('bg-gray-600')){
                tag.classList.remove('bg-gray-600')
            }else{
                tag.classList.add('bg-gray-600')
            }
        })
    })

    document.addEventListener('submit',()=>{
        tags.forEach(tag=>{
            if (tag.classList.contains('bg-gray-600')){
                tagTable.push(tag.value.toString());
            }
            tagInput.value = tagTable ;
        })
    })
}
SelectTag();
