
    if(localStorage.expandedMenu==0) {
        $("body").addClass('sidebar-collapse');
    }
    
    $('body').bind('expanded.pushMenu', function() {
      localStorage.expandedMenu = 1;
    });
    
    $('body').bind('collapsed.pushMenu', function() {
      localStorage.expandedMenu = 0;
    });
