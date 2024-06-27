# Jak współtworzyć 🎨

Wszelkie commity powinny być opatrzone komentarzem *po polsku* o tym, co zostało wprowadzone do strony, w formie bezokolicznika (np. **zostało dodane...**). Commmit należy traktować jako "save" aktualnego stanu strony. Commitować należy często - wszelka mniejsza zmiana w kodzie powinna wiązać się z commitem. **Pushujemy oddzielne gałęzie, nigdy do `main`!**

## Konwencja nazewnicza gałęzi 🌿

Gałęzie należy nazywać w konwencji `${nazwa_typu_pracy}/${zadanie}`.

### Przykłady: 📚
- **refaktoryzacja/poprawa_kodu_php** - nazywamy tak gałąź, jeśli refaktoryzujemy kod PHP.
- **test/nowa_podstrona_dodania_użytkownika** - nazywamy tak gałąź, jeśli testujemy nową podstronę dodawania użytkownika.

## Zasady Commita 📜
- **Komentarze w języku polskim** - zawsze używaj języka polskiego w komentarzach commitów.
- **Bezokolicznik** - komentarze w formie bezokolicznika, np. **dodanie funkcji logowania**.
- **Częste commity** - commituj każdą mniejszą zmianę w kodzie.
- **Oddzielne gałęzie** - twórz i pushuj zmiany tylko do oddzielnych gałęzi, **nigdy do `main`!**

## Przykładowy Workflow 🔄
1. **Stwórz nową gałąź** zgodnie z konwencją nazewniczą.
    ```bash
    git checkout -b refaktoryzacja/poprawa_kodu_php
    ```
2. **Dokonaj zmian** w kodzie.
3. **Commituj zmiany** z odpowiednim komentarzem.
    ```bash
    git add .
    git commit -m "poprawa błędów w kodzie PHP"
    ```
4. **Pushuj zmiany** do nowej gałęzi.
    ```bash
    git push origin refaktoryzacja/poprawa_kodu_php
    ```

## Dlaczego to ważne? 🚀
- **Zrozumiałość:** Jasne i zrozumiałe komentarze commitów pomagają wszystkim członkom zespołu zrozumieć, co zostało zmienione i dlaczego.
- **Śledzenie zmian:** Częste commity pozwalają na dokładne śledzenie postępu pracy i szybkie wychwytywanie błędów.
- **Bezpieczeństwo:** Praca na oddzielnych gałęziach minimalizuje ryzyko konfliktów i pozwala na bezpieczne integrowanie zmian.

## Pamiętaj! 🧠
- **Używaj polskiego** w komentarzach commitów.
- **Commituj często** - każda mała zmiana zasługuje na commita!
- **Twórz i pushuj oddzielne gałęzie** - nigdy nie pushuj bezpośrednio do `main`!

🌟 **Współpracujmy efektywnie i dbajmy o porządek w naszym repozytorium!** 🌟
