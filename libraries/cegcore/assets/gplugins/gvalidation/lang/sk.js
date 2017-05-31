jQuery.gvalidation.errors = jQuery.extend(jQuery.gvalidation.errors, {
	required: "Toto pole je povinné.",
	alpha: "Toto pole môže obsahovať iba písmena.",
	alphanum: "Do tohoto poľa môžete zadávať iba alfanumerické znaky.",
	nodigit: "Toto pole nemôže obsahovať číslice.",
	digit: "Toto pole môže obsahovať iba celé kladné čísla.",
	digitmin: "Číslo musí byť minimálne %1",
	digitltd: "Hodnota musí byť v intervale %1 až %2",
	number: "Číslo prosím zadajte v správnom formáte.",
	email: "Prosím, zadajte e-mail v správnom formáte: Napr. VaseMeno@domena.sk",
	image : 'Toto pole môže obsahovať iba obrázky',
	phone: "Prosím, zadajte telefónne číslo v správnom formáte. Napr.: 09xxxxxxxx",
	phone_inter:"Prosím, zadajte telefónne číslo v správnom medzinárodnom formáte. Napr.: +4219xxxxxxxx",
	url: "URL prosím zadajte v správnom formáte: Napr. http://www.domena.sk",
	confirm: "Pole nie je totožné s poľom %1",
	differs: "Toto pole musí byť odlišné od %1",
	length_str: "Zadaný reťazec nemá správnu dĺžku, musí byť v rozsahu %1 a %2",
	length_fix: "Zadaný reťazec nemá správnu dĺžku, musí mať dĺžku presne %1 znakov",
	lengthmax: "Zadaný reťazec nemá správnu dĺžku, môže byť dlhý maximálne %1 znakov",
	lengthmin: "Zadaný reťazec nemá správnu dĺžku, musí byť kratší než %1 znakov",
	words_min : "Toto pole musí obsahovať minimálne %1 slov. Momentálne má iba: %2 slov",
	words_range : "Toto pole musí obsahovať %1-%2 slov. Momentálne má: %3 slov",
	words_max : "Toto pole môže obsahovať maximálne %1 slov. Momentálne má: %2 slov",
	checkbox: "Zaškrtnutie tohoto checkboxu je povinné",
	group : 'Prosím, vyberte minimálne %1 možnosť(-í)',
	custom: "Prosím vyberte jednu z možností",
	select: "Prosím vyberte jednu z možností",
	select_multiple : "Prosím vyberte jednu, alebo viacej možností"
});