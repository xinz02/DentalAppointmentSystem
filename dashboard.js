window.addEventListener('scroll', function()
{
    var stickyDiv = document.getElementById('sticky');
    var scrollPosition = window.scrollY;
    var imageLi = document.querySelector(".image-li");

    if(scrollPosition > 0)
    {
        stickyDiv.classList.remove('transparent');
        stickyDiv.classList.add('change-color');
        imageLi.style.display = 'list-item';
    }
    else
    {
        stickyDiv.classList.remove('change-color');
        stickyDiv.classList.add('transparent');
        imageLi.style.display = 'none';
    }
})