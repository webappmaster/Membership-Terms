/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

CRM.$(document).ready(function(){
    CRM.$( document ).on('click', 'a.membershipterms-view-contribution', function(event){
        event.preventDefault();
        CRM.loadPage(jQuery(this).attr('href'));
    });    
});
