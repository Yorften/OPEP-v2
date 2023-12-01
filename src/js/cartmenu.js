function openPopup() {
    var popup = document.getElementById('popup');
    popup.classList.add('open');
}


function closePopup() {
    var popup = document.getElementById('popup');
    popup.classList.remove('open');
}
document.addEventListener('click', function(event) {
    const popup = document.getElementById('popup');
    if (!popup.contains(event.target) && !event.target.matches('.open-btn')) {
        popup.classList.remove('open');
    }
});