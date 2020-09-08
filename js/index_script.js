 let bonuses = {
        "asia": 'азиатское бенто',
        "russia":'русское компо',
        "america":'большой бургер',
        "penka":'пирожное и поп-корн',
        "dutyfree":'коктейль'
    };
    let changeBonus = function(event){
        $('#offer')[0].innerHTML = bonuses[event.target.value];
    };
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
    let inputNameField = $('#name');
    let inputFriendNameField = $('#friendName');
    let inputPhoneField = $('#phone_1');
    let inputFriendPhoneField = $('#phone_2');
    let agreementCheckbox = $('#agreement__checkbox');

    let checkInputs = function(event){
        let noContent = false;

        if((inputNameField[0].value === "" || inputPhoneField[0].value === "")
            && (inputFriendNameField[0].value === "" || inputFriendPhoneField[0].value === "") || !agreementCheckbox[0].checked){
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

		if(event.target.id === 'me'){
        if(inputNameField[0].value === "" && noContent){
            inputNameField.addClass("incorrect-input-content");
        }else{
            inputNameField.removeClass("incorrect-input-content");
        }
		
		if(inputPhoneField[0].value === "" && noContent){
            inputPhoneField.addClass("incorrect-input-content");
        }else {
            inputPhoneField.removeClass("incorrect-input-content");
        }

        
		}

		if(event.target.id === 'for_friend'){
        if(inputFriendNameField[0].value === "" && noContent){
            inputFriendNameField.addClass("incorrect-input-content");
        }else{
            inputFriendNameField.removeClass("incorrect-input-content");
        }

        if(inputFriendPhoneField[0].value === "" && noContent){
            inputFriendPhoneField.addClass("incorrect-input-content");
        }else{
            inputFriendPhoneField.removeClass("incorrect-input-content");
        }
		}



    };
    $(function(){
        $("#phone_1").mask("+7(999) 999-9999");
        $("#phone_2").mask("+7(999) 999-9999");
        $('#arrival').on('change', changeBonus);
        $('#form .button').on('click', checkInputs);
		$('.agreement').on('click', displayPopup);
		$('#agreement_cancel').on('click', hidePopup);
		$('#agreement_ok').on('click', makeAgreementChecked);
		
    });