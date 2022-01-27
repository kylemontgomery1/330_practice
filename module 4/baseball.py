#imports
import re
import sys, os

#grab filename
if len(sys.argv) < 2:
    sys.exit(f"Usage: {sys.argv[0]} filename")

filename = sys.argv[1]

if not os.path.exists(filename):
    sys.exit(f"Error: File '{sys.argv[1]}' not found")

#setting up regex
regex = re.compile(r"^([\w\s]+)\sbatted\s(\d{0,100})\stimes\swith\s(\d{0,100})\shits\sand\s\d{0,100}\sruns$")
base={}

def player_stats(test):
	match = regex.match(test)
	if match is not None:
		return match.group(1), int(match.group(2)), int(match.group(3))
	else:
		return False

#parsing through file
with open(filename) as f:
    for line in f:
        if player_stats(line) != False :
            name, bats, hits = player_stats(line)
            if name not in base:
                base[name] = {'bats':bats, 'hits':hits}
            else:
                base[name]['bats'] += bats
                base[name]['hits'] += hits

#calculating batting percentage
bats = {}

for player in base.keys():
    bats[player] = float(base[player]['hits'])/float(base[player]['bats'])

#sorting players
sorted = dict(sorted(bats.items(), key=lambda item: -item[1]))

#printing batting percentages to console
for player in sorted.keys():
    print(f'{player}: {sorted[player]:.3f}')

