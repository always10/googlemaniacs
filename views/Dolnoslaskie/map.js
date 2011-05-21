function(doc) {
  var i;
  for(i in doc.Placemark)
  {
        if(doc.Placemark[i].AddressDetails.Country.CountryName == "Polska" && doc.Placemark[i].AddressDetails.Country.AdministrativeArea.AdministrativeAreaName =="Dolnośląskie")
recent-items/map.js {
  recent-items/map.js recent-items/emit(doc.Placemark[i].address, [doc.Placemark[i].Point.coordinates[0],doc.Placemark[i].Point.coordinates[1]]);
recent-items/map.js }
  }
}
