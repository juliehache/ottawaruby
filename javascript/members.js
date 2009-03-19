// A database? A data structure? A JSON ghetto-base.
var members = [
  {"name": "Dwayne Litzenberger",
   "projects": [{"name": "Ruby Pixels",
                 "url": "http://www.dlitz.net/software/ruby-pixels/"}]},
  {"name": "James MacAulay",
   "projects": [{"name": "Active Shipping",
                 "url": "http://github.com/Shopify/active_shipping"}]},
  {"name": "Bryan Larsen",
   "projects": [{"name": "Hobo Contrib",
                 "url": "http://bryanlarsen.github.com/hobo-contrib/"}]},
  {"name": "Ryan Lowe",
   "projects": [{"name": "Acts As Indestructible",
                 "url": "http://github.com/ryanlowe/acts_as_indestructible/tree/master"}]}
];

$(document).ready(function() {
  
  // Shuffle members
  members.sort(function(a,b){return Math.round(Math.random())*-1})
  
  for (var i=0; i < 4; i++) {
    var member = members.shift();
    var name = member.name;
    var project = member.projects[0];
    
    var memberElement = $("<div class='member'></div>").text(name);
    var projectElement = $("<div class='projects'></div>").html(
                           $("<a></a>").attr("href", project.url).text(project.name));

    $("#members").append(
      $("<li></li>").append(memberElement).
                     append(projectElement));
  };
});