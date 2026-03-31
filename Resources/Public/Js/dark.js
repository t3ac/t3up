
    var prefersDarkScheme;
    var currentTheme;
    var currentSize; 
    
    function checkDarkMode() {
        currentTheme= localStorage.getItem("color-mode");
        if (currentTheme== "dark") {
            document.documentElement.setAttribute("color-mode", "dark");
        } else if (currentTheme== "contrast") {
            document.documentElement.setAttribute("color-mode", "contrast");
        } else {
            prefersDarkScheme= window.matchMedia("(prefers-color-scheme: dark)");
            if(prefersDarkScheme.matches) {
                document.documentElement.setAttribute("color-mode", "system-dark");
           } else {document.documentElement.setAttribute("color-mode", "system-light");
        }
     }
     setTimeout(checkDarkMode, 5000);
  }

  
      function checkfontSize() {
        currentSize= localStorage.getItem("font-size");
        if (currentSize !== null) {
            document.documentElement.setAttribute("style", 'font-size:' + currentSize + 'rem');
        }
      }
        
    checkfontSize();      
    checkDarkMode();