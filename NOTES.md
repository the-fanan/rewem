Change of password is to be handled by group-admin. App should not automatically handle this for security reasons.

setting up local access
- find local IP from ifconfig|grep inet or ip addr show|grep inet
- run sudo php artisan serve --host LOCAL_IP
10.42.0.1
//comparing distance formula -- Haversine formula
function distance(lat1,lon1,lat2,lon2){
  var R = 6371; // Earth's radius in Km
  return Math.acos(Math.sin(lat1)*Math.sin(lat2) + 
                  Math.cos(lat1)*Math.cos(lat2) *
                  Math.cos(lon2-lon1)) * R;
}


if (distance(user.lat, user.lon, post.lat, post.lon) <= desiredRadiusInKm){
  // return true;
} else {
  // return false;
}<br>
