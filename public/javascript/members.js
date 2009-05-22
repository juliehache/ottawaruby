// A database? A data structure? A JSON ghetto-base.
var members = [
  {"name": "Dwayne Litzenberger",
   "projects": [{"name": "Ruby Pixels",
                 "url": "http://www.dlitz.net/software/ruby-pixels/"}]},
  {"name": "Tobi Lütke",
   "projects": [{"name": "Liquid",
                 "url": "http://github.com/tobi/liquid/tree/master"}]},
  {"name": "Chris Schmitt",
   "projects": [{"name": "GiftMyList",
                 "url": "http://www.giftmylist.com/"}]},
  {"name": "Michael Richardson",
   "projects": [{"name": "TransitTime",
                 "url": "http://bluerose.sandelman.ca/projects/show/transittime"}]},
  {"name": "John Tajima",
   "projects": [{"name": "Exhibition",
                 "url": "http://exhibitionquality.com/"}]},
  {"name": "James MacAulay",
   "projects": [{"name": "Active Shipping",
                 "url": "http://github.com/Shopify/active_shipping"}]},
  {"name": "Bryan Larsen",
   "projects": [{"name": "Hobo Contrib",
                 "url": "http://bryanlarsen.github.com/hobo-contrib/"}]},
  {"name": "Ryan Lowe",
   "projects": [{"name": "Lighterest",
                 "url": "http://lighterest.com"}]}
];

$(document).ready(function() {
  
  // Shuffle members
  members.sort(function(a,b){return Math.round(Math.random())*-1})
  
  var chooseUpTo = 5
  
  chooseUpTo = (members.length >= chooseUpTo ? chooseUpTo : members.length)
  
  for (var i=0; i < 4; i++) {
    var member = members.shift();
    var name = member.name;
    var project = member.projects[0];
    
    var memberElement = $("<div class='member'></div>").text(name);
    var projectElement = $("<div class='projects'></div>").html(
                           $("<a></a>").attr("href", project.url).text(project.name));

    $("#members").prepend(
      $("<li></li>").append(memberElement).
                     append(projectElement));
  };
});