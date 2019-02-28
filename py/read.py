import comdb

comdb.insert_temp(2,3)
comdb.insert_humi(2,4)
comdb.insert_pres(2,10)
print comdb.get_temp(2)
comdb.update_setting("sample_rate", 65)
print comdb.get_setting("sample_rate")
comdb.end_con()
