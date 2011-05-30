function(keys,values)
{
	var max = 0;
	
	for(i in values)
	{
		if(values[i]>values[max]){max = i;}
	}
	return(values[max]);
}
