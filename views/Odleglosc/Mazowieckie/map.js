function(doc) {
var i;
//Warsaw
var XX = 21.0122287;
var YY = 52.2296756;
var dist;
for(i in doc.Placemark)
    {
        if(doc.Placemark[i].AddressDetails.Country.CountryName == "Polska" && doc.Placemark[i].AddressDetails.Country.AdministrativeArea.AdministrativeAreaName =="Mazowieckie")
            {
                var x = doc.Placemark[i].Point.coordinates[0];
                var y = doc.Placemark[i].Point.coordinates[1];
                var radlat1 = Math.PI * y/180;
                var radlat2 = Math.PI * YY/180;
                var radlon1 = Math.PI * x/180;
                var radlon2 = Math.PI * XX/180;
                var theta = x-XX;
                var radtheta = Math.PI * theta/180;
                var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                dist = Math.acos(dist);
                dist = dist * 180/Math.PI;
                dist = dist * 60 * 1.1515;
                dist = dist * 1.609344;
                emit([x,y,XX,YY],dist);
            }
    }
}