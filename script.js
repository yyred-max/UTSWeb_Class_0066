<script>
    function updateRatingDisplay(radioGroupName, displayElementId) {
        const radioButtons = document.querySelectorAll('input[name="${radioGroupName}"]');
        const displayElemen = document.getElementById(displayElemenId);

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    displayElement.textContent = ' (Rating: ${this.value}⭐)';
                }
            });
        });
    }
    updateRatingDisplay('rating-laskar', 'laskar-rating-value');
</script>