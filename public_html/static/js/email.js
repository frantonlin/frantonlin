function email() {
  (function () {

    $(document).ready(function() {
      // Email obfuscator script 2.1 by Tim Williams, University of Arizona
      // Random encryption key feature by Andrew Moulden, Site Engineering Ltd
      // This code is freeware provided these four comment lines remain intact
      // A wizard to generate this code is at http://www.jottings.com/obfuscator/
      var coded = "2tRufAu.r1u@9fKmNuf9.Ar1u.NmK",
      key = "WnioqQMHRgd57Ep6Y02w9NtZVklvzBu1AxF4SyOmhaXC83IGbcLfjserPJTKUD",
      shift=coded.length,
      link="";
      for (var i=0; i<coded.length; i++) {
        if (key.indexOf(coded.charAt(i))==-1) {
          var ltr = coded.charAt(i);
          link += (ltr);
        } else {     
          var ltr = (key.indexOf(coded.charAt(i))-shift+key.length) % key.length;
          link += (key.charAt(ltr));
        }
      }
      var emailLinks = document.getElementsByClassName("my-email")
      for (var i=0; i<emailLinks.length; i++) {
        emailLinks[i].href = "mailto:"+link;
      }
    });

  }());

}

email();