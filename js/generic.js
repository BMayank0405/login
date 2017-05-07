
	$('.c_report_view').on('click',function()
	{
		$('.c_report_view').removeClass('active');

		$(this).addClass('active');
		var c_view = this.getAttribute('report-type');
		var form;

		switch(c_view)
		{

			case 'd_enlist':
			form = '<form class="inline-form"><h2>Enlist</h2> <input type="submit" name="enlist_report" value="Generate Enlisted"> </form> ';
			break;

			case 'd_dispatch':
			form = '<form class="inline-form"><h2>Dispatch</h2> <input type="submit" name="dispatch_report" value="View Report"> </form> ';
			break;

			case 'd_delivery':
			form = '<form class="inline-form"><h2>Delivery</h2> <input type="submit" name="delivery_report" value="View Report"> </form> ';
			break;

			case 'd_failed':
			form = '<form class="inline-form"><h2>Cancel</h2>  <input type="submit" name="cancel_report" value="View Report"> </form> ';
			break;

			case 'd_charge':
			form = '<form class="inline-form"><h2>Charges</h2> <input type="submit" name="charges_report" value="View Report"> </form> ';
			break;

			case 'r_request':
			form = '<form class="inline-form"><h2>Requested Pickup</h2> <input type="submit" name="r_request" value="Requested Pickup"> </form> ';
			break;

			case 'r_out':
			form = '<form class="inline-form"><h2>Out for Pickup</h2> <input type="submit" name="r_out" value="Out for Pickup"> </form> ';
			break;

			case 'r_received':
			form = '<form class="inline-form"><h2>Pickup Received</h2> <input type="submit" name="r_received" value="Pickup Received"> </form> ';
			break;

			case 'r_failed':
			form = '<form class="inline-form"><h2>Failed Pickup</h2> <input type="submit" name="r_failed" value="Failed Pickup"> </form> ';
			break;

			case 'r_charges':
			form = '<form class="inline-form"><h2>Pickup Charges</h2> <input type="submit" name="r_charges" value="Pickup Charges"> </form> ';
			break;

		}

		$('#report_container').html(' ');
		$('#report_container').append(form);

	});
	$('.print-view').on('click',function()
	{
		$('#report_container').printThis();
	});

	$('.print-invoice').on('click',function()
	{

	 $("#client_invoice").printThis({
	       debug: false,
	       importCSS: true,
	       importStyle: true,
	       printContainer: true,
	       loadCSS: "http://www.evencargo.in/fresh/staff_user/css/generic.css",
	       pageTitle: "",
	       removeInline: false,
	       printDelay: 333,
	       header: null,
	       formValues: true
	   });


	});
	$('#cancel-invoice').on('click',function()
	{
		$('.invoice_container').css('display','none');
	});


	$('#select_all').on('click',function()
	{
		if(this.checked)
		{
			$(':checkbox').each(function()
			{
				this.checked = true;
			});
		}
		else
		{
			$(':checkbox').each(function()
			{
				this.checked = false;
			});
		}
	});

});
