function email() {
  (function () {

    $(document).ready(function() {
      // Email obfuscator script 2.1 by Tim Williams, University of Arizona
      // Random encryption key feature by Andrew Moulden, Site Engineering Ltd
      // This code is freeware provided these four comment lines remain intact
      // A wizard to generate this code is at http://www.jottings.com/obfuscator/
      var coded = "V2icOVc@QhOic2iFBi.V2Z",
      key = "2nx4rYaH07QdvjtWeFNX6mqiG3hAOSwRKybkcE9TospZLBJDu8fIUCz15lVgMP",
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