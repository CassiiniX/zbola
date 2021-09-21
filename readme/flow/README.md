<h4> Alur : </h4>

<ul>
	<li>
        Pertama kali invoice di buat statusnya adalah pending (PENDING)	    
	    Di admin terdapat 2 opsi :
        <dd> 
    	   <dt>Admin dapat menolak (REJECTED)</dt>
    	   <dt>Admin dapat merubah status menjadi pembayaran (PAYMENT)</dt>
	    </dd>
    </li>

	<li>
         Jika belum membayar sampai batas waktu yang di tentukan maka admin dapat mengagalkan invoice (FAILED)
	</li>

	<li>
         Jika sudah membayar status selanjutnya adalah menunggu (WAITING)
    </li>

	<li>
         Jika sudah dalam waktu penyewaan maka statusnya adalah dalam penyewaan (RUNNING)
    </li>
	 
	 <li>
         Jika sudah selesai waktu penyewaan maka statusnya adalah selesai (COMPELTED)
    </li>
</ul>
