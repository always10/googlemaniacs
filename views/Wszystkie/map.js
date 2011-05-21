function(doc) {
  var i;
  for(i in doc.Placemark)
  {
        if(doc.Placemark[i].AddressDetails.Country.CountryName == "Polska")
{
  emit(doc.Placemark[i].address, [doc.Placemark[i].Point.coordinates[0],doc.Placemark[i].Point.coordinates[1]]);
}
  }
}
