# Abgabe

- Erstellen Sie EINE konsolidierte Version der Klasse UsernameEnumeration
- Verwenden Sie ein einheitliches Layout (Einrückung, Kommentare, etc.)
- Jede Funktion in der Klasse hat den gleichen Namen wie der Hook der sie aufruft.
- Jede Funktion hat einen Kommentar der erklärt was die Funktion tut. Englisch und verständlich für Endanwender.
- Der Kommentar enthält eine Liste der "Affected URLs"
- Der Kommentar enhält eine Liste von Personen die zu dieser Funktion beigetragen haben, jeweils mit dem Zusatz (Research, Development oder QA)

---

```
/**
 * Prevents the actual usernames from being 
 * displayed on the author pages
 * 
 * Contributors:
 * --- Max Mustermann (Research, Development)
 * --- Helga Schuster (QA)
 *
 * Affected URLs:
 * --- http://localhost/author/admin
 * --- http://localhost/?author=1
 * --- http://localhost/wp-sitemap-users-1.xml
 * --- http://localhost/hello-world/
 */
 ```