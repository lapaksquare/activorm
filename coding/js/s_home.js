$(document).ready(function(){
   var cache = {
      'team':{
         'teams': $('.teams').hide(),
         'teamSelect': $('#teamSelect'),
         'funcChangeTeam': function(){
            this.teams.hide();
            $('#team-' + this.teamSelect.val()).slideDown(500);
         }
      }
   };
   
   cache.team.teamSelect.on('change', function(){
      cache.team.funcChangeTeam();
   });
      
   cache.team.funcChangeTeam();
});