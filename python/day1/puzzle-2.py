import numpy as np
inputFile = open("input.txt")
input = np.array([])
for line in inputFile:
  input = np.append(input,int(line))
inputFile.close()
idxRoot = 0
answerString = "{}, {}, and {} equal 2020 so the answer is {}"
testInput = np.array([979, 366, 299, 675, 1721, 1456])
#input = testInput
while idxRoot < len(input):
    first = int(idxRoot)
    second = int(idxRoot) + 1
    third = int(idxRoot) + 2
    while second < len(input):
        while third < len(input):
            checkFirst = int(input[first])
            checkSecond = int(input[second])
            checkThird = int(input[third])
            sum = checkFirst + checkSecond + checkThird
            if sum == 2020:
                answer = checkFirst * checkSecond * checkThird
                print(answerString.format(checkFirst, checkSecond, checkThird, answer))
            third += 1 
        second += 1
        third = second + 1
    idxRoot += 1