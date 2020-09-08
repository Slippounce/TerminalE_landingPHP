 let hidePopup = function(){
		parentPopup[0].style.display = 'none';
	};
	let displayPopup = function(event){
		event.preventDefault();
		if(!agreementCheckbox[0].checked){
			parentPopup[0].style.display = 'block';
		}else{
			agreementCheckbox[0].checked = false;
		}
	};
	let makeAgreementChecked = function(){
		agreementCheckbox[0].checked = true;
		hidePopup();
	};
	
	
	let parentPopup = $('.parent_popup');
	let inputFriendNameField = $('#friendName');
    let inputFriendPhoneField = $('#phone_2');
    let agreementCheckbox = $('#agreement__checkbox');
	
    let checkInputs = function(event){
        let noContent = false;
        if(inputFriendNameField[0].value === "" || inputFriendPhoneField[0].value === "" || !agreementCheckbox[0].checked){
            noContent = true;
        }
        if(noContent){
            event.preventDefault();
        }

        if(!agreementCheckbox[0].checked){
            agreementCheckbox.parent().addClass("incorrect-input-content");
        }else{
            agreementCheckbox.parent().removeClass("incorrect-input-content");
        }

        if(inputFriendNameField[0].value === ""){
            inputFriendNameField.addClass("incorrect-input-content");
        }else{
            inputFriendNameField.removeClass("incorrect-input-content");
        }

        if(inputFriendPhoneField[0].value === ""){
            inputFriendPhoneField.addClass("incorrect-input-content");
        }else{
            inputFriendPhoneField.removeClass("incorrect-input-content");
        }

    };

    $(function(){
        $("#phone_2").mask("+7(999) 999-9999");
        $('#form .button').on('click', checkInputs);
		$('.agreement').on('click', displayPopup);
		$('#agreement_cancel').on('click', hidePopup);
		$('#agreement_ok').on('click', makeAgreementChecked);
    });