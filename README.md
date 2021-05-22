# LV 3 zadatak - Čvarci.net v2

### Heroku LINK: https://web-lv3-tvor1.herokuapp.com/

<hr />

## Opis zadatka

Nakon što ste lansirali stranicu Čvarci.net, klijenti su zadovoljni odrađenim poslom i ponovno su se javili Pakiu za određene stvari. Ovaj puta došli 
su na ideju da na početnoj stranici imaju rubriku gdje ljudi mogu direktno naručiti njihove određene proizvode. Pošto im se trenutno ne žuri, žele samo vizualno vidjeti kako bi to izgledalo na početnoj stranici - prije nego se odluče ići na backend implementaciju. Kada je Paki vidio što klijenti žele, pozlilo mu je i traži ponovno vašu pomoć. Klijent želi sljedeće:

#### Potrebno je:

1. Na početnoj stranici postoji rubrika s proizvodima gdje korisnik može definirati količina određenog proizvoda i dodati ga u košaricu.
2. Kada klijent klikne na proizvod koji hoće kupiti, otvara se košarica i prikazuje se proizvod unutar košarice. Košarica se ažurira i pokazuje da je jedan proizvod unutar košarice. Također kada korisnik doda proizvod u košaricu, potrebno je onemogućiti button navedenog proizvoda kako korisnik ne bi ponovno pokušao dodati taj isti proizvod.
3. Ako korisnik doda veću količinu određenog proizvoda, unutar košarice se mora prikazati odgovarajuća cijena (tipa: 1komad 60kn, 2 komada 120kn).
4. Korisnik ima mogućnost brisanja proizvoda unutar košarice. Ako korisnik klikne na X ikonu proizvoda, proizvod se treba maknuti iz košarice te je potrebno ponovno osposobiti button od navedenog proizvoda.
5. (ZA MAKSIMALNE bodove) Ako klijent doda više od 3 proizvoda u svoju košaricu, potrebno je aktivirati vertikalni slider koji će u svome prikazu imati 3 proizvoda (jedan je sakriven). Klikom u smjeru gore ili dolje proizvodi se pomiču za jedan u nizu. Ako korisnik makne neki od navedenih proizvoda (nema ih više od 3 proizvoda), slider se mora deaktivirati i potrebno je vratiti stari prikaz košarice.


*Napomena: Vertikalni slider moguće je realizirati pomoću sljedećih library-a: [Swiper](https://swiperjs.com/), [Slick](https://kenwheeler.github.io/slick/),[OwlCarousel](https://owlcarousel2.github.io/OwlCarousel2/) ili ručno ga nakucati od 0.*


#### Figma link:

[Link](https://www.figma.com/file/OYR9Bxq0Ed2WyuNcDAcXGh/%C4%8Dvarci.net-v2?node-id=0%3A1)

Napravljen zadatak potrebno je postaviti na Heroku Servis i gore na "Heroku LINK:" dodati poveznicu na navedeni zadatak. Zadatak koji nije postavljen na Heroku servis bodovat će se s 0 bodova.

### Korisni linkovi prilikom rješavanja zadatka

- priprema.pdf

#### Figma

- https://www.smashingmagazine.com/2020/09/figma-developers-guide/
- https://www.figma.com/best-practices/tips-on-developer-handoff/an-overview-of-figma-for-developers/
- https://www.youtube.com/watch?v=hs_cXHkuHAM

#### CSS - općenito
- https://developer.mozilla.org/en-US/docs/Learn/CSS/First_steps/Getting_started
- https://css-tricks.com/where-do-you-learn-html-css-in-2020/
- Box model - https://developer.mozilla.org/en-US/docs/Learn/CSS/Building_blocks/The_box_model
- Position - https://developer.mozilla.org/en-US/docs/Web/CSS/position
- Display - https://developer.mozilla.org/en-US/docs/Web/CSS/display

#### CSS - responzivni web dizajn
- https://developer.mozilla.org/en-US/docs/Learn/CSS/CSS_layout/Responsive_Design
- https://kinsta.com/blog/responsive-web-design/
- https://www.youtube.com/watch?v=p0bGHP-PXD4

#### CSS - Grid i Flexbox
- https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Grid_Layout
- Grid - https://www.youtube.com/watch?v=0-DY8J_skZ0
- https://css-tricks.com/snippets/css/a-guide-to-flexbox/
- https://www.youtube.com/watch?v=JJSoEo8JSnc
- Kako kreirati svoj grid sistem - https://zellwk.com/blog/responsive-grid-system/
