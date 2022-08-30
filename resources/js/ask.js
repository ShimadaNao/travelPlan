window.onload = function(){
    if(window.confirm('ホテルは予約しましたか?')) {
        window.location.href = '/users/showMyPlan/'+ registeredPlanId;
    } else {
        window.location.href = '/users/searchHotel';
    }
}