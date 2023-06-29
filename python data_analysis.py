import mysql.connector

# Se connecter à la base de données
conn = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="gestions_projet"
)

# Créer un curseur pour exécuter des requêtes SQL
cursor = conn.cursor()

# Effectuer des requêtes SQL pour récupérer les données nécessaires
# Requête pour obtenir le nombre total de tâches créées
cursor.execute("SELECT COUNT(*) FROM taches")
total_tasks = cursor.fetchone()[0]

# Requête pour obtenir les catégories les plus choisies avec leurs pourcentages
cursor.execute("""
    SELECT c.nom, COUNT(*) as count, COUNT(*) * 100 / (SELECT COUNT(*) FROM taches) as percentage
    FROM taches t
    INNER JOIN categories c ON t.categorie_id = c.id
    GROUP BY c.nom
    ORDER BY count DESC
    LIMIT 5
""")
top_categories = cursor.fetchall()

# Requête pour obtenir les priorités les plus choisies avec leurs pourcentages
cursor.execute("""
    SELECT p.nom, COUNT(*) as count, COUNT(*) * 100 / (SELECT COUNT(*) FROM taches) as percentage
    FROM taches t
    INNER JOIN priorites p ON t.priorite_id = p.id
    GROUP BY p.nom
    ORDER BY count DESC
    LIMIT 5
""")
top_priorities = cursor.fetchall()

# Afficher les résultats
print("Nombre total de tâches créées:", total_tasks)

print("Catégories les plus choisies:")
for category in top_categories:
    print(category[0], "(", category[1], ") -", round(category[2], 2), "%")

print("Priorités les plus choisies:")
for priority in top_priorities:
    print(priority[0], "(", priority[1], ") -", round(priority[2], 2), "%")

# Fermer le curseur et la connexion à la base de données
cursor.close()
conn.close()
