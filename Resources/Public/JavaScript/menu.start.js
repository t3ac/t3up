jQuery(document).ready(function($) {

            new Mmenu(document.querySelector("#menu"));

            document.addEventListener("click", function (evnt) {
                var anchor = evnt.target.closest('a[href="#/"]');
                if (anchor) {
                    alert("Thank you for clicking, but that's a demo link.");
                    evnt.preventDefault();
                }
            });	
});
